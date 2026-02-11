<?php
namespace App;

final class Data {
  private const FILE = __DIR__ . '/../data/communes.json';
  private static ?array $communes = null;
  private static ?array $bySlug = null;

  public static function loadCommunes(): array {
    if (self::$communes !== null) return self::$communes;

    $path = self::FILE;
    if (!is_file($path)) {
      $sample = __DIR__ . '/../data/communes.sample.json';
      $path = is_file($sample) ? $sample : $path;
    }

    $json = is_file($path) ? file_get_contents($path) : '[]';
    $data = json_decode($json ?: '[]', true);
    if (!is_array($data)) $data = [];

    $norm = [];
    foreach ($data as $c) {
      if (!is_array($c)) continue;
      $name = (string)($c['name'] ?? $c['nom'] ?? '');
      $slug = (string)($c['slug'] ?? '');
      if ($name === '' || $slug === '') continue;

      $cp = (string)($c['cp'] ?? $c['postal_code'] ?? '');
      $postalCodes = $c['postal_codes'] ?? $c['codesPostaux'] ?? $c['codes_postaux'] ?? [];
      if (is_string($postalCodes)) $postalCodes = [$postalCodes];
      if (!is_array($postalCodes)) $postalCodes = [];
      if ($cp === '' && !empty($postalCodes)) $cp = (string)($postalCodes[0] ?? '');

      $department = (string)($c['department'] ?? $c['codeDepartement'] ?? '');
      $region = (string)($c['region'] ?? '');
      $insee = (string)($c['insee'] ?? $c['code'] ?? '');
      $population = (int)($c['population'] ?? 0);

      $lat = $c['lat'] ?? null;
      $lng = $c['lng'] ?? ($c['lon'] ?? null);
      $lat = is_numeric($lat) ? (float)$lat : null;
      $lng = is_numeric($lng) ? (float)$lng : null;

      $norm[] = [
        'name' => $name,
        'slug' => $slug,
        'cp' => $cp,
        'postal_codes' => array_values(array_filter(array_map('strval', $postalCodes))),
        'department' => $department,
        'region' => $region,
        'insee' => $insee,
        'population' => $population,
        'lat' => $lat,
        'lng' => $lng,
      ];
    }

    usort($norm, fn($a,$b)=> strcmp($a['name'], $b['name']));
    self::$communes = $norm;

    self::$bySlug = [];
    foreach ($norm as $c) self::$bySlug[$c['slug']] = $c;

    return $norm;
  }

  public static function findCommuneBySlug(string $slug): ?array {
    self::loadCommunes();
    return self::$bySlug[$slug] ?? null;
  }

  public static function alphaIndex(): array {
    $out = [];
    foreach (self::loadCommunes() as $c) {
      $first = self::getFirstLetter($c['name']);
      if (!preg_match('/^[A-Z]$/', $first)) $first = '#';
      $out[$first] ??= [];
      $out[$first][] = $c;
    }
    ksort($out);
    return $out;
  }

  private static function getFirstLetter(string $str): string {
    if ($str === '') return '';
    // Prend le premier caractère
    $first = substr($str, 0, 1);
    // Convertit en majuscule
    $first = strtoupper($first);
    // Supprime les accents
    $first = self::removeAccents($first);
    return $first;
  }

  private static function removeAccents(string $str): string {
    $accents = [
      'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
      'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a',
      'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
      'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e',
      'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
      'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
      'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
      'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o',
      'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U',
      'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u',
      'Ç' => 'C', 'ç' => 'c',
      'Ñ' => 'N', 'ñ' => 'n',
      'Œ' => 'OE', 'œ' => 'oe',
      'Æ' => 'AE', 'æ' => 'ae',
    ];
    return strtr($str, $accents);
  }

  public static function topByPopulation(int $n = 20): array {
    $all = self::loadCommunes();
    usort($all, fn($a,$b)=> ($b['population'] <=> $a['population']));
    return array_slice($all, 0, $n);
  }

  public static function nearby(array $current, int $n = 12): array {
    $all = self::loadCommunes();
    $slug = $current['slug'] ?? '';
    $lat = $current['lat'] ?? null;
    $lng = $current['lng'] ?? null;

    $others = array_values(array_filter($all, fn($c) => ($c['slug'] ?? '') !== $slug));

    if (is_float($lat) && is_float($lng)) {
      foreach ($others as &$c) {
        $cLat = $c['lat'] ?? null;
        $cLng = $c['lng'] ?? null;
        if (is_float($cLat) && is_float($cLng)) $c['_d'] = self::haversineKm($lat, $lng, $cLat, $cLng);
        else $c['_d'] = 99999.0;
      }
      unset($c);
      usort($others, fn($a,$b)=> ($a['_d'] <=> $b['_d']));
      $near = array_slice($others, 0, $n);
      foreach ($near as &$c) unset($c['_d']);
      return $near;
    }

    $index = self::indexOfSlug($slug);
    if ($index === null) { shuffle($others); return array_slice($others, 0, $n); }

    $near = [];
    for ($i=1; count($near) < $n && ($index-$i >= 0 || $index+$i < count($all)); $i++) {
      if ($index-$i >= 0) $near[] = $all[$index-$i];
      if (count($near) >= $n) break;
      if ($index+$i < count($all)) $near[] = $all[$index+$i];
    }
    return array_slice($near, 0, $n);
  }

  public static function prevNext(string $slug): array {
    $all = self::loadCommunes();
    $i = self::indexOfSlug($slug);
    if ($i === null) return [null, null];
    $prev = $i > 0 ? $all[$i-1] : null;
    $next = $i < count($all)-1 ? $all[$i+1] : null;
    return [$prev, $next];
  }

  private static function indexOfSlug(string $slug): ?int {
    foreach (self::loadCommunes() as $i => $c) {
      if (($c['slug'] ?? '') === $slug) return $i;
    }
    return null;
  }

  private static function haversineKm(float $lat1, float $lon1, float $lat2, float $lon2): float {
    $R = 6371.0;
    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);
    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    return $R * $c;
  }
}
