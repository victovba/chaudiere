<?php
namespace App;

final class LeadStore {
  private string $file;

  public function __construct(){
    $dir = __DIR__ . '/../storage/leads';
    @mkdir($dir, 0775, true);
    $this->file = $dir . '/leads-' . date('Y-m') . '.csv';
  }

  public function append(Lead $lead): void {
    $row = [
      date('c'),
      $lead->name,
      $lead->email,
      $lead->phone,
      $lead->service,
      $lead->city,
      $lead->citySlug,
      str_replace(["","
"], [' ',' '], $lead->message),
      $_SERVER['REMOTE_ADDR'] ?? '',
      $_SERVER['HTTP_USER_AGENT'] ?? '',
    ];

    $fp = fopen($this->file, 'ab');
    if ($fp) { fputcsv($fp, $row, ';'); fclose($fp); }
  }
}
