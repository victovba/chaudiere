<?php
namespace App;

final class Mailer {
  private array $config;
  public function __construct(array $config){ $this->config = $config; }

  public function sendLead(Lead $lead): void {
    $to = $this->config['lead_to_email'] ?? '';
    if ($to === '') return;

    $subject = '[Chaudière Vosges] Nouveau message' . ($lead->city ? ' - ' . $lead->city : '');
    $body = "Nouveau lead

";
    $body .= "Nom: {$lead->name}
";
    $body .= "Email: {$lead->email}
";
    $body .= "Téléphone: {$lead->phone}
";
    $body .= "Service: {$lead->service}
";
    $body .= "Ville: {$lead->city} ({$lead->citySlug})

";
    $body .= "Message:
{$lead->message}

";
    $body .= "IP: " . ($_SERVER['REMOTE_ADDR'] ?? '') . "
";

    $headers = [];
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/plain; charset=utf-8';
    $headers[] = 'From: ' . ($this->config['brand'] ?? 'Site') . ' <no-reply@' . ($this->config['domain'] ?? 'example.com') . '>';
    $headers[] = 'Reply-To: ' . $lead->email;

    try { @mail($to, $subject, $body, implode("
", $headers)); } catch (\Throwable $e) { /* noop */ }
  }
}
