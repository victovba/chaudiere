<?php
namespace App;

final class View {
  private array $config;
  public function __construct(array $config){ $this->config = $config; }

  public function render(string $template, array $vars = []): void {
    $config = $this->config;
    extract($vars, EXTR_SKIP);

    $templateFile = __DIR__ . '/../templates/' . $template . '.php';
    if (!is_file($templateFile)) throw new \RuntimeException('Template not found: ' . $template);

    require __DIR__ . '/../templates/layout.php';
  }
}
