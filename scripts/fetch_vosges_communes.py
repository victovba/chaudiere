#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""Télécharge les communes des Vosges (département 88) depuis l'API geo.api.gouv.fr.

Endpoints utilisés (voir documentation officielle) :
- /departements/{code}/communes
- /regions

Sortie :
- data/communes.json (format compatible avec le site PHP)

Usage:
  python3 scripts/fetch_vosges_communes.py
"""

from __future__ import annotations

import json
import unicodedata
from pathlib import Path
from typing import Dict, List, Any, Tuple

import requests

BASE_URL = "https://geo.api.gouv.fr"
DEPT = "88"


def get_json(url: str, params: Dict[str, str] | None = None, timeout: int = 30) -> Any:
    r = requests.get(url, params=params, timeout=timeout)
    r.raise_for_status()
    return r.json()


def telecharger_regions() -> Dict[str, str]:
    regions: Dict[str, str] = {}
    for region in get_json(f"{BASE_URL}/regions"):
        regions[str(region.get("code"))] = str(region.get("nom"))
    return regions


def telecharger_communes_departement(code_dept: str) -> List[Dict[str, Any]]:
    params = {
        "fields": "nom,code,codesPostaux,codeDepartement,codeRegion,population,centre",
        "format": "json",
        "geometry": "centre",
    }
    return get_json(f"{BASE_URL}/departements/{code_dept}/communes", params=params, timeout=60)


def slugify(text: str) -> str:
    text = (text or "").strip().lower()
    text = unicodedata.normalize("NFD", text)
    text = "".join(ch for ch in text if unicodedata.category(ch) != "Mn")
    text = text.replace("œ", "oe").replace("'", "-").replace(" ", "-")
    out = []
    for ch in text:
        if ch.isalnum() or ch == "-":
            out.append(ch)
    text = "".join(out)
    while "--" in text:
        text = text.replace("--", "-")
    return text.strip("-") or "ville"


def extract_lat_lng(centre: Dict[str, Any] | None) -> Tuple[float | None, float | None]:
    if not centre:
        return None, None
    coords = centre.get("coordinates")
    if not coords or not isinstance(coords, list) or len(coords) != 2:
        return None, None
    lng, lat = coords
    try:
        return float(lat), float(lng)
    except Exception:
        return None, None


def formatter_commune(commune: Dict[str, Any], regions: Dict[str, str]) -> Dict[str, Any]:
    codes_postaux = commune.get("codesPostaux") or []
    if isinstance(codes_postaux, str):
        codes_postaux = [codes_postaux]

    postal_code = str(codes_postaux[0]) if codes_postaux else ""

    name = str(commune.get("nom") or "")
    slug = slugify(name)

    lat, lng = extract_lat_lng(commune.get("centre"))

    code_region = str(commune.get("codeRegion") or "")
    nom_region = regions.get(code_region, "")

    pop = commune.get("population")
    try:
        pop = int(pop) if pop is not None else 0
    except Exception:
        pop = 0

    return {
        "name": name,
        "slug": slug,
        "department": str(commune.get("codeDepartement") or ""),
        "region": nom_region,
        "postal_code": postal_code,
        "postal_codes": [str(x) for x in codes_postaux if x],
        "insee": str(commune.get("code") or ""),
        "population": pop,
        "lat": lat,
        "lng": lng,
    }


def ensure_unique_slugs(items: List[Dict[str, Any]]) -> None:
    seen = set()
    for item in items:
        base = item.get("slug") or "ville"
        slug = base
        i = 2
        while slug in seen:
            slug = f"{base}-{i}"
            i += 1
        seen.add(slug)
        item["slug"] = slug


def main() -> None:
    print("=" * 72)
    print("Téléchargement des communes — Vosges (88)")
    print("=" * 72)

    regions = telecharger_regions()
    communes = telecharger_communes_departement(DEPT)

    formatted = [formatter_commune(c, regions) for c in communes]
    ensure_unique_slugs(formatted)
    formatted.sort(key=lambda x: x.get("name", ""))

    out_path = Path(__file__).resolve().parent.parent / "data" / "communes.json"
    out_path.parent.mkdir(parents=True, exist_ok=True)
    out_path.write_text(json.dumps(formatted, ensure_ascii=False, indent=2), encoding="utf-8")

    print(f"✅ {len(formatted)} communes écrites dans {out_path}")


if __name__ == "__main__":
    main()
