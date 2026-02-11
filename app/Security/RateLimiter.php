<?php
namespace App\Security;

/**
 * Système de Rate Limiting
 * 
 * Limite le nombre de requêtes par IP pour éviter :
 * - Attaques par force brute
 * - Spam sur le formulaire de contact
 * - Scan de répertoires
 * - Déni de service (DoS)
 */
final class RateLimiter {
  private const STORAGE_DIR = __DIR__ . '/../../storage/ratelimit';
  
  // Limites par défaut
  private const DEFAULT_LIMIT = 60;    // 60 requêtes
  private const DEFAULT_WINDOW = 60;   // par minute
  
  // Limites spécifiques par route
  private const ROUTE_LIMITS = [
    '/contact' => ['limit' => 5, 'window' => 300],    // 5 envois par 5 minutes
    '/login' => ['limit' => 3, 'window' => 300],      // 3 tentatives par 5 minutes
    '/api/' => ['limit' => 30, 'window' => 60],       // 30 appels API par minute
  ];

  /**
   * Vérifie si la requête est autorisée
   * 
   * @param string $identifier Identifiant unique (IP ou session)
   * @param string $route Route actuelle (optionnel)
   * @return array ['allowed' => bool, 'remaining' => int, 'reset' => int]
   */
  public static function check(string $identifier, string $route = ''): array {
    self::ensureStorageDir();
    
    $key = self::getKey($identifier, $route);
    $file = self::STORAGE_DIR . '/' . $key . '.json';
    
    // Déterminer les limites pour cette route
    $limits = self::getLimitsForRoute($route);
    $limit = $limits['limit'];
    $window = $limits['window'];
    
    // Charger l'état actuel
    $data = self::loadData($file);
    $now = time();
    
    // Nettoyer les anciennes entrées
    $data = self::cleanOldEntries($data, $now, $window);
    
    // Vérifier le nombre de requêtes
    $requestCount = count($data);
    $remaining = max(0, $limit - $requestCount);
    $reset = $now + $window;
    
    if ($requestCount >= $limit) {
      // Limite atteinte
      self::logBlockedRequest($identifier, $route, $requestCount);
      return [
        'allowed' => false,
        'remaining' => 0,
        'reset' => $reset,
        'retry_after' => $reset - $now,
      ];
    }
    
    // Ajouter la requête actuelle
    $data[] = $now;
    self::saveData($file, $data);
    
    return [
      'allowed' => true,
      'remaining' => $remaining - 1,
      'reset' => $reset,
    ];
  }

  /**
   * Vérifie et bloque si nécessaire (pour utilisation dans Router)
   */
  public static function middleware(): void {
    $ip = self::getClientIp();
    $route = $_SERVER['REQUEST_URI'] ?? '/';
    
    $result = self::check($ip, $route);
    
    if (!$result['allowed']) {
      // Ajouter headers pour informer le client
      header('HTTP/1.1 429 Too Many Requests');
      header('Retry-After: ' . $result['retry_after']);
      header('X-RateLimit-Limit: ' . self::getLimitsForRoute($route)['limit']);
      header('X-RateLimit-Remaining: 0');
      header('X-RateLimit-Reset: ' . $result['reset']);
      
      // Afficher message d'erreur
      echo '<!DOCTYPE html>
<html>
<head><title>Trop de requêtes</title></head>
<body style="font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px;">
  <h1>429 - Trop de requêtes</h1>
  <p>Vous avez effectué trop de requêtes en peu de temps.</p>
  <p>Veuillez réessayer dans ' . $result['retry_after'] . ' secondes.</p>
  <p>Si vous pensez qu\'il s\'agit d\'une erreur, veuillez nous contacter.</p>
</body>
</html>';
      exit;
    }
    
    // Ajouter headers informatifs
    header('X-RateLimit-Limit: ' . self::getLimitsForRoute($route)['limit']);
    header('X-RateLimit-Remaining: ' . $result['remaining']);
    header('X-RateLimit-Reset: ' . $result['reset']);
  }

  /**
   * Obtient l'adresse IP du client
   */
  private static function getClientIp(): string {
    $headers = ['HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'];
    
    foreach ($headers as $header) {
      if (!empty($_SERVER[$header])) {
        $ip = $_SERVER[$header];
        // Si plusieurs IPs (proxy), prendre la première
        if (strpos($ip, ',') !== false) {
          $ips = explode(',', $ip);
          $ip = trim($ips[0]);
        }
        
        // Validation basique IP
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
          return $ip;
        }
        
        // Si IP privée mais pas d'autre choix
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
          return $ip;
        }
      }
    }
    
    return 'unknown';
  }

  /**
   * Génère une clé unique pour le stockage
   */
  private static function getKey(string $identifier, string $route): string {
    $routeHash = md5($route);
    return md5($identifier . '_' . $routeHash);
  }

  /**
   * Détermine les limites pour une route spécifique
   */
  private static function getLimitsForRoute(string $route): array {
    foreach (self::ROUTE_LIMITS as $pattern => $limits) {
      if (strpos($route, $pattern) !== false) {
        return $limits;
      }
    }
    
    return ['limit' => self::DEFAULT_LIMIT, 'window' => self::DEFAULT_WINDOW];
  }

  /**
   * Charge les données du fichier
   */
  private static function loadData(string $file): array {
    if (!is_file($file)) {
      return [];
    }
    
    $content = file_get_contents($file);
    $data = json_decode($content, true);
    
    return is_array($data) ? $data : [];
  }

  /**
   * Sauvegarde les données dans le fichier
   */
  private static function saveData(string $file, array $data): void {
    file_put_contents($file, json_encode($data), LOCK_EX);
  }

  /**
   * Supprime les entrées plus anciennes que la fenêtre
   */
  private static function cleanOldEntries(array $data, int $now, int $window): array {
    $cutoff = $now - $window;
    return array_filter($data, fn($time) => $time > $cutoff);
  }

  /**
   * Crée le répertoire de stockage si nécessaire
   */
  private static function ensureStorageDir(): void {
    if (!is_dir(self::STORAGE_DIR)) {
      mkdir(self::STORAGE_DIR, 0750, true);
      // Créer un .htaccess pour protéger ce répertoire
      file_put_contents(self::STORAGE_DIR . '/.htaccess', "Deny from all\n");
    }
  }

  /**
   * Log une requête bloquée
   */
  private static function logBlockedRequest(string $identifier, string $route, int $count): void {
    $logFile = __DIR__ . '/../../storage/logs/security.log';
    $logDir = dirname($logFile);
    
    if (!is_dir($logDir)) {
      mkdir($logDir, 0750, true);
    }
    
    $entry = [
      'timestamp' => date('Y-m-d H:i:s'),
      'type' => 'RATE_LIMIT_EXCEEDED',
      'ip' => $identifier,
      'route' => $route,
      'request_count' => $count,
      'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
    ];
    
    error_log(json_encode($entry) . "\n", 3, $logFile);
  }
}
