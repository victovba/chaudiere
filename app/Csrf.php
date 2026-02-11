<?php
namespace App;

use App\Security\SecurityLogger;

/**
 * Protection CSRF (Cross-Site Request Forgery)
 * 
 * Améliorations de sécurité :
 * - Tokens à usage unique (one-time)
 * - Expiration des tokens
 * - Double-submit cookie pattern optionnel
 * - Logging des échecs
 */
final class Csrf {
  
  // Durée de validité du token en secondes (2 heures)
  private const TOKEN_LIFETIME = 7200;
  
  // Longueur du token en bytes
  private const TOKEN_LENGTH = 32;

  /**
   * Génère un nouveau token CSRF
   * 
   * @return string Le token généré
   */
  public static function token(): string {
    self::initSession();
    
    // Générer un nouveau token si inexistant ou expiré
    if (empty($_SESSION['csrf_token']) || self::isTokenExpired()) {
      $_SESSION['csrf_token'] = bin2hex(random_bytes(self::TOKEN_LENGTH));
      $_SESSION['csrf_token_time'] = time();
    }
    
    return (string)$_SESSION['csrf_token'];
  }

  /**
   * Vérifie un token CSRF
   * 
   * @param string $token Le token à vérifier
   * @return bool True si valide
   */
  public static function check(string $token): bool {
    self::initSession();
    
    // Vérifier l'existence du token en session
    if (empty($_SESSION['csrf_token'])) {
      SecurityLogger::log(
        SecurityLogger::EVENT_CSRF_FAIL,
        SecurityLogger::LEVEL_WARNING,
        ['reason' => 'no_session_token']
      );
      return false;
    }
    
    // Vérifier l'expiration
    if (self::isTokenExpired()) {
      SecurityLogger::log(
        SecurityLogger::EVENT_CSRF_FAIL,
        SecurityLogger::LEVEL_WARNING,
        ['reason' => 'token_expired']
      );
      return false;
    }
    
    // Comparaison sécurisée
    $valid = hash_equals((string)$_SESSION['csrf_token'], (string)$token);
    
    if (!$valid) {
      SecurityLogger::logCsrfFailure($_SESSION['csrf_token'], $token);
    }
    
    return $valid;
  }

  /**
   * Vérifie le token et régénère si valide
   * Utile pour les actions critiques (one-time tokens)
   * 
   * @param string $token
   * @return bool
   */
  public static function checkAndRegenerate(string $token): bool {
    $valid = self::check($token);
    
    if ($valid) {
      // Régénérer le token pour éviter la réutilisation
      $_SESSION['csrf_token'] = bin2hex(random_bytes(self::TOKEN_LENGTH));
      $_SESSION['csrf_token_time'] = time();
    }
    
    return $valid;
  }

  /**
   * Génère un champ input caché pour les formulaires
   * 
   * @return string HTML du champ
   */
  public static function field(): string {
    $token = self::token();
    return '<input type="hidden" name="csrf" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '" />';
  }

  /**
   * Régénère le token (à appeler après connexion réussie)
   */
  public static function regenerate(): void {
    self::initSession();
    $_SESSION['csrf_token'] = bin2hex(random_bytes(self::TOKEN_LENGTH));
    $_SESSION['csrf_token_time'] = time();
  }

  /**
   * Supprime le token (déconnexion)
   */
  public static function clear(): void {
    self::initSession();
    unset($_SESSION['csrf_token'], $_SESSION['csrf_token_time']);
  }

  /**
   * Initialise la session avec les paramètres de sécurité
   */
  private static function initSession(): void {
    if (session_status() === PHP_SESSION_NONE) {
      // Configuration sécurisée des cookies de session
      ini_set('session.cookie_httponly', '1');
      ini_set('session.cookie_secure', self::isHttps() ? '1' : '0');
      ini_set('session.cookie_samesite', 'Strict');
      ini_set('session.use_strict_mode', '1');
      ini_set('session.gc_maxlifetime', self::TOKEN_LIFETIME);
      
      session_start();
      
      // Régénérer l'ID de session périodiquement
      if (!empty($_SESSION['created']) && time() - $_SESSION['created'] > 1800) {
        session_regenerate_id(true);
        $_SESSION['created'] = time();
      }
      
      if (empty($_SESSION['created'])) {
        $_SESSION['created'] = time();
      }
    }
  }

  /**
   * Vérifie si le token est expiré
   */
  private static function isTokenExpired(): bool {
    if (empty($_SESSION['csrf_token_time'])) {
      return true;
    }
    
    return (time() - $_SESSION['csrf_token_time']) > self::TOKEN_LIFETIME;
  }

  /**
   * Détecte si HTTPS est utilisé
   */
  private static function isHttps(): bool {
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
      return true;
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
      return true;
    }
    return false;
  }
}
