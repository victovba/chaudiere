<?php
namespace App;

final class Cache {
  private string $dir;
  private int $ttl;

  public function __construct(array $config){
    $this->dir = __DIR__ . '/../storage/cache';
    $this->ttl = (int)($config['cache_ttl_seconds'] ?? 3600);
  }

  public function get(string $key): ?string {
    $file = $this->file($key);
    if (!is_file($file)) return null;
    if (time() - filemtime($file) > $this->ttl) return null;
    return file_get_contents($file) ?: null;
  }

  public function set(string $key, string $content): void {
    @file_put_contents($this->file($key), $content, LOCK_EX);
  }

  private function file(string $key): string {
    $safe = preg_replace('/[^a-z0-9\-_.]/i', '_', $key);
    return $this->dir . '/' . $safe . '.html';
  }
}
