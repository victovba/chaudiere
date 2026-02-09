<?php
declare(strict_types=1);

spl_autoload_register(function(string $class){
  $prefix = 'App\\';
  if (strncmp($prefix, $class, strlen($prefix)) !== 0) return;

  $rel = substr($class, strlen($prefix));

  // Remplace les séparateurs de namespace "\" par "/"
  $path = __DIR__ . '/' . str_replace('\\', '/', $rel) . '.php';

  if (is_file($path)) require $path;
});

// Ensure storage dirs
$storage = __DIR__ . '/../storage';
@mkdir($storage . '/cache', 0775, true);
@mkdir($storage . '/leads', 0775, true);