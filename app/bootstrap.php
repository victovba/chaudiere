<?php
declare(strict_types=1);

use App\Security\SecurityHeaders;
use App\Security\SecurityLogger;
use App\Security\InputValidator;
use App\Security\RateLimiter;

spl_autoload_register(function(string $class){
  $prefix = 'App\\';
  if (strncmp($prefix, $class, strlen($prefix)) !== 0) return;

  $rel = substr($class, strlen($prefix));

  // Remplace les séparateurs de namespace "\" par "/"
  $path = __DIR__ . '/' . str_replace('\\', '/', $rel) . '.php';

  if (is_file($path)) require $path;
});

// ============================================
// INITIALISATION DE LA SÉCURITÉ
// ============================================

// 1. Appliquer les headers de sécurité HTTP
SecurityHeaders::apply();
SecurityHeaders::removeServerInfo();

// 2. Rate Limiting (pour les requêtes non-GET)
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
  RateLimiter::middleware();
}

// 3. Analyser la requête pour détecter les attaques
SecurityLogger::analyzeRequest();
InputValidator::detectInjection();

// ============================================
// CONFIGURATION SESSION SÉCURISÉE
// ============================================

// Configurer les cookies de session AVANT session_start()
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_secure', isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? '1' : '0');
ini_set('session.cookie_samesite', 'Strict');
ini_set('session.use_strict_mode', '1');
ini_set('session.gc_maxlifetime', '7200'); // 2 heures
ini_set('session.use_only_cookies', '1');

// ============================================
// RÉPERTOIRES DE STOCKAGE
// ============================================

// Ensure storage dirs with secure permissions
$storage = __DIR__ . '/../storage';
$directories = [
  'cache' => 0750,
  'leads' => 0750,
  'logs' => 0750,
  'ratelimit' => 0750,
];

foreach ($directories as $dir => $perm) {
  $path = $storage . '/' . $dir;
  if (!is_dir($path)) {
    mkdir($path, $perm, true);
    // Créer un .htaccess pour protéger le répertoire
    $htaccess = $path . '/.htaccess';
    if (!is_file($htaccess)) {
      file_put_contents($htaccess, "Deny from all\n");
    }
  }
}

// ============================================
// PROTECTION SUPPLÉMENTAIRE
// ============================================

// Désactiver l'affichage des erreurs en production
if (!isset($_SERVER['DEBUG']) || !$_SERVER['DEBUG']) {
  ini_set('display_errors', '0');
  ini_set('display_startup_errors', '0');
  error_reporting(0);
} else {
  ini_set('display_errors', '1');
  ini_set('display_startup_errors', '1');
  error_reporting(E_ALL);
}

// Limite de mémoire et temps d'exécution
ini_set('memory_limit', '128M');
ini_set('max_execution_time', '30');

// Désactiver les fonctions dangereuses (si possible)
if (function_exists('ini_set')) {
  $disabledFunctions = ['exec', 'passthru', 'shell_exec', 'system', 'proc_open', 'popen', 'curl_exec', 'curl_multi_exec', 'parse_ini_file', 'show_source'];
  ini_set('disable_functions', implode(',', $disabledFunctions));
}
