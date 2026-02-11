<?php
namespace App;

final class DataEPCI {
  private const FILE = __DIR__ . '/../data/epci-silos.json';
  private static ?array $silos = null;
  private static ?array $bySlug = null;
  private static ?array $communeToSilo = null;

  public static function loadSilos(): array {
    if (self::$silos !== null) return self::$silos;

    $path = self::FILE;
    $json = is_file($path) ? file_get_contents($path) : '{"silos":[]}';
    $data = json_decode($json ?: '{"silos":[]}', true);
    
    if (!is_array($data) || !isset($data['silos'])) {
      self::$silos = [];
      return [];
    }

    self::$silos = $data['silos'];
    
    // Index par slug
    self::$bySlug = [];
    foreach (self::$silos as $silo) {
      self::$bySlug[$silo['slug']] = $silo;
    }

    // Index commune -> silo
    self::$communeToSilo = [];
    foreach (self::$silos as $silo) {
      foreach ($silo['communes'] ?? [] as $commune) {
        $communeSlug = $commune['slug'] ?? '';
        if ($communeSlug) {
          self::$communeToSilo[$communeSlug] = $silo['slug'];
        }
      }
    }

    return self::$silos;
  }

  public static function findSiloBySlug(string $slug): ?array {
    self::loadSilos();
    return self::$bySlug[$slug] ?? null;
  }

  public static function findSiloByCommuneSlug(string $communeSlug): ?array {
    self::loadSilos();
    $siloSlug = self::$communeToSilo[$communeSlug] ?? null;
    if (!$siloSlug) return null;
    return self::$bySlug[$siloSlug] ?? null;
  }

  public static function getNearbyCommunes(string $communeSlug, int $n = 4): array {
    $silo = self::findSiloByCommuneSlug($communeSlug);
    if (!$silo) return [];

    $currentIndex = -1;
    $communes = $silo['communes'] ?? [];
    
    foreach ($communes as $i => $c) {
      if (($c['slug'] ?? '') === $communeSlug) {
        $currentIndex = $i;
        break;
      }
    }

    if ($currentIndex === -1) return [];

    // Prendre les communes avant et après
    $nearby = [];
    for ($i = 1; $i <= $n; $i++) {
      if (isset($communes[$currentIndex + $i])) {
        $nearby[] = $communes[$currentIndex + $i];
      }
      if (isset($communes[$currentIndex - $i])) {
        $nearby[] = $communes[$currentIndex - $i];
      }
    }

    return array_slice($nearby, 0, $n);
  }

  public static function getAllCommunesCount(): int {
    $silos = self::loadSilos();
    $count = 0;
    foreach ($silos as $silo) {
      $count += count($silo['communes'] ?? []);
    }
    return $count;
  }
}
