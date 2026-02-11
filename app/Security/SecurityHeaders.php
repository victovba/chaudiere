<?php
namespace App\Security;

/**
 * Gestion des headers de sécurité HTTP
 * 
 * Ces headers protègent contre :
 * - XSS (Cross-Site Scripting)
 * - Clickjacking
 * - MIME sniffing
 * - Man-in-the-middle attacks
 */
final class SecurityHeaders {
  
  /**
   * Liste des headers de sécurité à appliquer
   */
  private static array $headers = [
    // Protection contre le clickjacking
    'X-Frame-Options' => 'SAMEORIGIN',
    
    // Protection XSS navigateur
    'X-XSS-Protection' => '1; mode=block',
    
    // Empêcher MIME sniffing
    'X-Content-Type-Options' => 'nosniff',
    
    // Contrôle referrer
    'Referrer-Policy' => 'strict-origin-when-cross-origin',
    
    // Permissions des features
    'Permissions-Policy' => 'geolocation=(), microphone=(), camera=(), payment=(), usb=(), magnetometer=(), gyroscope=(), fullscreen=(self)',
  ];

  /**
   * Applique tous les headers de sécurité
   */
  public static function apply(): void {
    // Vérifier si les headers ont déjà été envoyés
    if (headers_sent()) {
      return;
    }

    // Headers de base
    foreach (self::$headers as $name => $value) {
      header("$name: $value");
    }

    // Content Security Policy (CSP) - protection XSS avancée
    self::applyCSP();

    // Strict Transport Security (HSTS) - forcer HTTPS
    self::applyHSTS();

    // Cache control pour les pages sensibles
    self::applyCacheControl();
  }

  /**
   * Content Security Policy
   * Définit quelles ressources peuvent être chargées
   */
  private static function applyCSP(): void {
    $csp = [
      "default-src 'self'",
      "script-src 'self' 'unsafe-inline' https://unpkg.com",
      "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://unpkg.com",
      "font-src 'self' https://fonts.gstatic.com",
      "img-src 'self' data: https://*.tile.openstreetmap.org blob:",
      "connect-src 'self'",
      "media-src 'self'",
      "object-src 'none'",
      "frame-ancestors 'self'",
      "base-uri 'self'",
      "form-action 'self'",
    ];

    header('Content-Security-Policy: ' . implode('; ', $csp));
  }

  /**
   * HTTP Strict Transport Security
   * Force l'utilisation de HTTPS
   */
  private static function applyHSTS(): void {
    // Uniquement si HTTPS est utilisé
    if (self::isHttps()) {
      header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
    }
  }

  /**
   * Cache Control
   * Empêche la mise en cache des pages sensibles
   */
  private static function applyCacheControl(): void {
    $path = $_SERVER['REQUEST_URI'] ?? '/';
    
    // Pages qui ne doivent pas être mises en cache
    $noCachePaths = ['/contact', '/admin', '/login'];
    
    foreach ($noCachePaths as $noCache) {
      if (strpos($path, $noCache) !== false) {
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
        header('Pragma: no-cache');
        header('Expires: Thu, 19 Nov 1981 08:52:00 GMT');
        return;
      }
    }
  }

  /**
   * Vérifie si la connexion est en HTTPS
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

  /**
   * Supprime les headers qui révèlent des informations sur le serveur
   */
  public static function removeServerInfo(): void {
    // Ces headers sont souvent ajoutés par PHP/Apache
    // On les remplace par des valeurs vagues ou génériques
    header_remove('X-Powered-By');
    header_remove('Server');
    
    // On ne peut pas vraiment supprimer Server dans tous les cas,
    // mais on peut le masquer via .htaccess
  }
}
