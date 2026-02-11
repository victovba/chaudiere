<?php
namespace App;

final class Lead {
  public string $name = '';
  public string $email = '';
  public string $phone = '';
  public string $city = '';
  public string $citySlug = '';
  public string $message = '';
  public string $service = '';
  public string $consent = '';
  public string $hp = '';
  public string $csrf = '';

  private array $errors = [];

  public static function fromPost(array $post): self {
    $l = new self();
    $l->name = trim((string)($post['name'] ?? ''));
    $l->email = trim((string)($post['email'] ?? ''));
    $l->phone = trim((string)($post['phone'] ?? ''));
    $l->city = trim((string)($post['city'] ?? ''));
    $l->citySlug = trim((string)($post['city_slug'] ?? ''));
    $l->service = trim((string)($post['service'] ?? ''));
    $l->message = trim((string)($post['message'] ?? ''));
    $l->consent = (string)($post['consent'] ?? '');
    $l->hp = (string)($post['website'] ?? '');
    $l->csrf = (string)($post['csrf'] ?? '');
    $l->validate();
    return $l;
  }

  private function validate(): void {
    if ($this->hp !== '') { $this->errors['global'] = 'Requête invalide.'; return; }
    if (!Csrf::check($this->csrf)) { $this->errors['global'] = 'Session expirée. Merci de réessayer.'; return; }

    if ($this->name === '' || mb_strlen($this->name) < 2) $this->errors['name'] = 'Nom requis.';
    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) $this->errors['email'] = 'Email invalide.';
    if ($this->phone === '' || mb_strlen(preg_replace('/\D+/', '', $this->phone)) < 8) $this->errors['phone'] = 'Téléphone requis.';
    if ($this->message === '' || mb_strlen($this->message) < 10) $this->errors['message'] = 'Message trop court.';
    if ($this->consent !== '1') $this->errors['consent'] = 'Consentement requis.';
  }

  public function isValid(): bool { return empty($this->errors); }
  public function errors(): array { return $this->errors; }

  public function toArray(): array {
    return [
      'name' => $this->name,
      'email' => $this->email,
      'phone' => $this->phone,
      'city' => $this->city,
      'city_slug' => $this->citySlug,
      'service' => $this->service,
      'message' => $this->message,
      'consent' => $this->consent,
    ];
  }
}
