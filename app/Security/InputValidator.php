<?php
namespace App\Security;

/**
 * Validation et sanitization des entrées utilisateur
 * 
 * Protection contre :
 * - XSS (Cross-Site Scripting)
 * - Injection SQL
 * - Directory Traversal
 * - File Inclusion
 */
final class InputValidator {
  
  /**
   * Valide et sanitize une chaîne de texte
   * 
   * @param string $input Valeur d'entrée
   * @param int $maxLength Longueur maximale
   * @param string $allowedChars Regex des caractères autorisés
   * @return string|null Retourne null si invalide
   */
  public static function string(
    string $input,
    int $maxLength = 255,
    string $allowedChars = '/^[\p{L}\p{N}\s\-_.@]+$/u'
  ): ?string {
    // Vérifier la longueur
    if (strlen($input) > $maxLength) {
      return null;
    }
    
    // Vérifier les caractères autorisés
    if (!preg_match($allowedChars, $input)) {
      return null;
    }
    
    // Strip tags
    $input = strip_tags($input);
    
    // Trim
    $input = trim($input);
    
    return $input;
  }

  /**
   * Valide un email
   */
  public static function email(string $input): ?string {
    $email = filter_var($input, FILTER_SANITIZE_EMAIL);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return null;
    }
    
    return $email;
  }

  /**
   * Valide un numéro de téléphone (format français)
   */
  public static function phone(string $input): ?string {
    // Supprimer tous les caractères non numériques
    $phone = preg_replace('/[^0-9]/', '', $input);
    
    // Vérifier longueur (10 chiffres pour France)
    if (strlen($phone) !== 10) {
      return null;
    }
    
    // Vérifier qu'il commence par 0
    if (!str_starts_with($phone, '0')) {
      return null;
    }
    
    return $phone;
  }

  /**
   * Valide un code postal français
   */
  public static function postalCode(string $input): ?string {
    $cp = preg_replace('/[^0-9]/', '', $input);
    
    if (strlen($cp) !== 5) {
      return null;
    }
    
    // Codes postaux des Vosges commencent par 88
    if (!str_starts_with($cp, '88')) {
      return null;
    }
    
    return $cp;
  }

  /**
   * Valide un slug (pour URLs)
   */
  public static function slug(string $input): ?string {
    // Un slug valide : lettres, chiffres, tirets
    if (!preg_match('/^[a-z0-9-]+$/', $input)) {
      return null;
    }
    
    // Empêcher directory traversal
    if (strpos($input, '..') !== false) {
      SecurityLogger::logDirectoryTraversal($input);
      return null;
    }
    
    return $input;
  }

  /**
   * Valide un nom de ville/commune
   */
  public static function cityName(string $input): ?string {
    // Lettres, espaces, tirets, apostrophes
    if (!preg_match('/^[\p{L}\s\-\'\.]+$/u', $input)) {
      return null;
    }
    
    if (strlen($input) > 100) {
      return null;
    }
    
    return trim($input);
  }

  /**
   * Sanitize un message/texte long
   * Permet certains tags HTML basiques
   */
  public static function message(string $input, int $maxLength = 5000): ?string {
    if (strlen($input) > $maxLength) {
      return null;
    }
    
    // Tags HTML autorisés
    $allowedTags = '<br><p><strong><em><ul><ol><li>';
    $input = strip_tags($input, $allowedTags);
    
    // Supprimer les attributs dangereux
    $input = preg_replace('/on\w+\s*=\s*["\']?[^"\'>]*["\']?/i', '', $input);
    $input = preg_replace('/javascript:/i', '', $input);
    
    return trim($input);
  }

  /**
   * Valide et sanitize les paramètres GET
   */
  public static function validateGetParams(array $allowedParams): array {
    $validated = [];
    
    foreach ($_GET as $key => $value) {
      // Vérifier si le paramètre est autorisé
      if (!isset($allowedParams[$key])) {
        SecurityLogger::log(
          SecurityLogger::EVENT_INVALID_INPUT,
          SecurityLogger::LEVEL_WARNING,
          ['unexpected_param' => $key, 'value' => self::truncate($value)]
        );
        continue;
      }
      
      $rule = $allowedParams[$key];
      $sanitized = self::applyRule($value, $rule);
      
      if ($sanitized !== null) {
        $validated[$key] = $sanitized;
      }
    }
    
    return $validated;
  }

  /**
   * Valide et sanitize les paramètres POST
   */
  public static function validatePostParams(array $allowedParams): array {
    $validated = [];
    
    foreach ($_POST as $key => $value) {
      if (!isset($allowedParams[$key])) {
        // Ignorer les champs non attendus mais ne pas bloquer
        // (peut être des champs honeypot ou techniques)
        continue;
      }
      
      $rule = $allowedParams[$key];
      $sanitized = self::applyRule($value, $rule);
      
      if ($sanitized !== null) {
        $validated[$key] = $sanitized;
      }
    }
    
    return $validated;
  }

  /**
   * Applique une règle de validation
   */
  private static function applyRule($value, string $rule): ?string {
    if (!is_string($value)) {
      return null;
    }
    
    return match($rule) {
      'string' => self::string($value),
      'email' => self::email($value),
      'phone' => self::phone($value),
      'postal' => self::postalCode($value),
      'slug' => self::slug($value),
      'city' => self::cityName($value),
      'message' => self::message($value),
      'int' => filter_var($value, FILTER_VALIDATE_INT) !== false ? (string)(int)$value : null,
      'bool' => in_array(strtolower($value), ['1', 'true', 'on', 'yes']) ? '1' : '0',
      default => self::string($value),
    };
  }

  /**
   * Détecte et bloque les tentatives d'injection
   */
  public static function detectInjection(): bool {
    $suspicious = false;
    
    // Patterns dangereux
    $patterns = [
      'sql' => '/(\b(SELECT|INSERT|UPDATE|DELETE|DROP|UNION|ALTER|EXEC|SCRIPT)\b.*\b(FROM|INTO|TABLE|DATABASE)\b)/i',
      'xss' => '/<(script|iframe|object|embed)|javascript:|on\w+\s*=|eval\s*\(|expression\s*\(/i',
      'lfi' => '/(\.\.\/|\.\.\\|\.%00|\/etc\/passwd|\/windows\/system32)/i',
      'cmd' => '/[`;|&]|\$\(|\$\{|system\s*\(|exec\s*\(/i',
    ];
    
    $allInput = array_merge($_GET, $_POST);
    
    foreach ($allInput as $key => $value) {
      if (!is_string($value)) continue;
      
      foreach ($patterns as $type => $pattern) {
        if (preg_match($pattern, $value)) {
          $suspicious = true;
          
          match($type) {
            'sql' => SecurityLogger::logSqlInjectionAttempt($value, "param:$key"),
            'xss' => SecurityLogger::logXssAttempt($value, "param:$key"),
            'lfi' => SecurityLogger::logDirectoryTraversal($value),
            default => SecurityLogger::log(
              SecurityLogger::EVENT_INVALID_INPUT,
              SecurityLogger::LEVEL_WARNING,
              ['type' => $type, 'param' => $key]
            ),
          };
        }
      }
    }
    
    return $suspicious;
  }

  /**
   * Tronquer une valeur pour le logging
   */
  private static function truncate($value, int $length = 100): string {
    if (!is_string($value)) {
      return json_encode($value);
    }
    if (strlen($value) > $length) {
      return substr($value, 0, $length) . '...';
    }
    return $value;
  }
}
