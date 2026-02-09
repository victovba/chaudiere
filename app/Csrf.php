<?php
namespace App;

final class Csrf {
  public static function token(): string {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(16));
    return (string)$_SESSION['csrf'];
  }

  public static function check(string $token): bool {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    return isset($_SESSION['csrf']) && hash_equals((string)$_SESSION['csrf'], (string)$token);
  }
}
