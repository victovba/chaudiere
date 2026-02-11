<?php
namespace App\Security;

/**
 * Système de logs de sécurité
 * 
 * Enregistre les événements suspects :
 * - Tentatives d'accès aux fichiers sensibles
 * - Erreurs CSRF
 * - Requêtes malformées
 * - Scan de répertoires
 * - Accès depuis IPs suspectes
 */
final class SecurityLogger {
  private const LOG_DIR = __DIR__ . '/../../storage/logs';
  private const LOG_FILE = self::LOG_DIR . '/security.log';
  
  // Niveaux de gravité
  public const LEVEL_INFO = 'INFO';
  public const LEVEL_WARNING = 'WARNING';
  public const LEVEL_CRITICAL = 'CRITICAL';
  
  // Types d'événements
  public const EVENT_CSRF_FAIL = 'CSRF_VALIDATION_FAILED';
  public const EVENT_RATE_LIMIT = 'RATE_LIMIT_EXCEEDED';
  public const EVENT_SENSITIVE_FILE_ACCESS = 'SENSITIVE_FILE_ACCESS';
  public const EVENT_INVALID_INPUT = 'INVALID_INPUT_DETECTED';
  public const EVENT_DIRECTORY_TRAVERSAL = 'DIRECTORY_TRAVERSAL_ATTEMPT';
  public const EVENT_SUSPICIOUS_USER_AGENT = 'SUSPICIOUS_USER_AGENT';
  public const EVENT_SQL_INJECTION_ATTEMPT = 'SQL_INJECTION_ATTEMPT';
  public const EVENT_XSS_ATTEMPT = 'XSS_ATTEMPT';
  public const EVENT_FILE_INCLUSION_ATTEMPT = 'FILE_INCLUSION_ATTEMPT';

  /**
   * Enregistre un événement de sécurité
   */
  public static function log(
    string $event,
    string $level = self::LEVEL_INFO,
    array $context = []
  ): void {
    self::ensureLogDir();
    
    $entry = [
      'timestamp' => date('Y-m-d H:i:s'),
      'level' => $level,
      'event' => $event,
      'ip' => self::getClientIp(),
      'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
      'uri' => $_SERVER['REQUEST_URI'] ?? '/',
      'method' => $_SERVER['REQUEST_METHOD'] ?? 'GET',
      'referrer' => $_SERVER['HTTP_REFERER'] ?? null,
      'context' => $context,
    ];
    
    $logLine = json_encode($entry, JSON_UNESCAPED_SLASHES) . "\n";
    error_log($logLine, 3, self::LOG_FILE);
    
    // Si événement critique, envoyer une alerte
    if ($level === self::LEVEL_CRITICAL) {
      self::sendAlert($entry);
    }
  }

  /**
   * Log une tentative de CSRF échouée
   */
  public static function logCsrfFailure(string $expected, string $received): void {
    self::log(self::EVENT_CSRF_FAIL, self::LEVEL_WARNING, [
      'expected_token_hash' => substr(md5($expected), 0, 8) . '...',
      'received_token_hash' => substr(md5($received), 0, 8) . '...',
      'post_data' => self::sanitizePostData(),
    ]);
  }

  /**
   * Log une tentative d'accès à un fichier sensible
   */
  public static function logSensitiveFileAccess(string $file): void {
    self::log(self::EVENT_SENSITIVE_FILE_ACCESS, self::LEVEL_CRITICAL, [
      'file' => $file,
      'backtrace' => debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 5),
    ]);
  }

  /**
   * Log une tentative d'injection SQL
   */
  public static function logSqlInjectionAttempt(string $input, string $location): void {
    self::log(self::EVENT_SQL_INJECTION_ATTEMPT, self::LEVEL_CRITICAL, [
      'input' => self::sanitizeInput($input),
      'location' => $location,
    ]);
  }

  /**
   * Log une tentative de XSS
   */
  public static function logXssAttempt(string $input, string $location): void {
    self::log(self::EVENT_XSS_ATTEMPT, self::LEVEL_CRITICAL, [
      'input' => self::sanitizeInput($input),
      'location' => $location,
    ]);
  }

  /**
   * Log une tentative de directory traversal
   */
  public static function logDirectoryTraversal(string $input): void {
    self::log(self::EVENT_DIRECTORY_TRAVERSAL, self::LEVEL_WARNING, [
      'input' => $input,
      'decoded_input' => urldecode($input),
    ]);
  }

  /**
   * Analyse les paramètres GET/POST pour détecter des attaques
   */
  public static function analyzeRequest(): void {
    $patterns = [
      'sql_injection' => '/(\b(SELECT|INSERT|UPDATE|DELETE|DROP|UNION|ALTER|CREATE)\b.*\b(FROM|INTO|TABLE|DATABASE)\b)|(--|#|\/\*|\*\/)/i',
      'xss' => '/<(script|iframe|object|embed|form)|javascript:|on\w+\s*=|eval\s*\(/i',
      'directory_traversal' => '/\.\.\/|\.\.\\\\|%2e%2e%2f|%2e%2e\\/i',
      'file_inclusion' => '/(file|php|data|expect|input):\/\//i',
    ];
    
    $allInput = array_merge($_GET, $_POST);
    
    foreach ($allInput as $key => $value) {
      if (!is_string($value)) continue;
      
      // Vérifier SQL injection
      if (preg_match($patterns['sql_injection'], $value)) {
        self::logSqlInjectionAttempt($value, "param:$key");
      }
      
      // Vérifier XSS
      if (preg_match($patterns['xss'], $value)) {
        self::logXssAttempt($value, "param:$key");
      }
      
      // Vérifier directory traversal
      if (preg_match($patterns['directory_traversal'], $value)) {
        self::logDirectoryTraversal($value);
      }
    }
    
    // Vérifier User-Agent suspect
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $suspiciousAgents = ['sqlmap', 'nikto', 'nmap', 'masscan', 'zgrab', 'gobuster', 'dirb'];
    foreach ($suspiciousAgents as $agent) {
      if (stripos($userAgent, $agent) !== false) {
        self::log(self::EVENT_SUSPICIOUS_USER_AGENT, self::LEVEL_WARNING, [
          'user_agent' => $userAgent,
          'matched' => $agent,
        ]);
      }
    }
  }

  /**
   * Obtient les dernières entrées du log
   */
  public static function getRecent(int $lines = 100): array {
    if (!is_file(self::LOG_FILE)) {
      return [];
    }
    
    $content = file_get_contents(self::LOG_FILE);
    $lines = explode("\n", trim($content));
    $lines = array_slice($lines, -$lines);
    
    return array_map(fn($line) => json_decode($line, true), $lines);
  }

  /**
   * Nettoie les vieux logs (garde 30 jours)
   */
  public static function cleanup(): void {
    if (!is_file(self::LOG_FILE)) return;
    
    $content = file_get_contents(self::LOG_FILE);
    $lines = explode("\n", trim($content));
    $cutoff = strtotime('-30 days');
    
    $filtered = array_filter($lines, function($line) use ($cutoff) {
      if (empty($line)) return false;
      $data = json_decode($line, true);
      if (!$data) return false;
      $timestamp = strtotime($data['timestamp'] ?? 'now');
      return $timestamp > $cutoff;
    });
    
    file_put_contents(self::LOG_FILE, implode("\n", $filtered) . "\n");
  }

  /**
   * Obtient l'IP client
   */
  private static function getClientIp(): string {
    $headers = ['HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'];
    
    foreach ($headers as $header) {
      if (!empty($_SERVER[$header])) {
        $ip = $_SERVER[$header];
        if (strpos($ip, ',') !== false) {
          $ips = explode(',', $ip);
          $ip = trim($ips[0]);
        }
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
          return $ip;
        }
      }
    }
    
    return 'unknown';
  }

  /**
   * Sanitize les données POST pour le log
   */
  private static function sanitizePostData(): array {
    $data = $_POST;
    // Masquer les champs sensibles
    $sensitiveFields = ['password', 'passwd', 'pwd', 'token', 'csrf', 'secret'];
    foreach ($sensitiveFields as $field) {
      if (isset($data[$field])) {
        $data[$field] = '***REDACTED***';
      }
    }
    return $data;
  }

  /**
   * Sanitize une entrée pour le log
   */
  private static function sanitizeInput(string $input): string {
    // Tronquer si trop long
    if (strlen($input) > 200) {
      $input = substr($input, 0, 200) . '...[truncated]';
    }
    return $input;
  }

  /**
   * Crée le répertoire de logs si nécessaire
   */
  private static function ensureLogDir(): void {
    if (!is_dir(self::LOG_DIR)) {
      mkdir(self::LOG_DIR, 0750, true);
      // Protéger le répertoire
      file_put_contents(self::LOG_DIR . '/.htaccess', "Deny from all\n");
    }
  }

  /**
   * Envoie une alerte pour les événements critiques
   */
  private static function sendAlert(array $entry): void {
    // Pour l'instant, on log juste dans error_log
    // À remplacer par envoi d'email ou notification Slack
    error_log('[SECURITY ALERT] ' . $entry['event'] . ' from ' . $entry['ip']);
  }
}
