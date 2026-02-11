# chaudiere-vosges.fr — site PHP léger (programmatic SEO)

Site **ultra léger**, sans framework, conçu pour générer des pages locales **/ville/{slug}** pour **toutes les communes des Vosges (88)**.

## ✅ Fonctionnalités
- Pages locales dynamiques : `/ville/{slug}`
- Répertoire A–Z (hub SEO) : `/communes` et `/communes/a` ... `/communes/z`
- Contenu qui varie selon la commune (nom, CP, département, région, population…)
- **Maillage interne optimisé** :
  - communes proches (distance lat/lng)
  - villes importantes (population)
  - liens prev/next alphabétiques
  - hubs A–Z
- **Bouton sticky** (devis gratuit) sur chaque page commune
- Formulaire de contact (CSRF + honeypot) + stockage local CSV + tentative d'email
- Sitemap XML dynamique : `/sitemap.xml`
- Design moderne & pro (CSS léger, pas de librairies externes)
- Cache HTML simple (1h par défaut) pour pages communes

## 🧰 Pré-requis
- PHP 8.0+ (recommandé 8.1/8.2)
- Apache avec `mod_rewrite` ou Nginx

## 🚀 Installation
1. Déployez le dossier sur votre hébergement.
2. Configurez votre vhost pour pointer vers **`public/`**.
3. Éditez `config.php` (email de réception, téléphone, base_url, etc.).

## 📍 Récupérer toutes les communes des Vosges (88)

### Option 1 — Script Python (API geo.api.gouv.fr)
```bash
python3 scripts/fetch_vosges_communes.py
```

→ génère `data/communes.json`

### Option 2 — Import CSV
```bash
php scripts/import_communes.php /chemin/communes.csv
```

## 🧾 Leads
- Les leads sont sauvegardés dans `storage/leads/leads-YYYY-MM.csv`.

## ⚠️ À personnaliser (obligatoire)
- Mentions légales: `templates/mentions.php`
- Politique de confidentialité: `templates/privacy.php`
- CGU: `templates/cgu.php`
- Email & téléphone dans `config.php`

Bon build 🚀
