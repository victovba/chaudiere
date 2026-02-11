<?php
/**
 * Importer une liste de communes dans data/communes.json
 *
 * Usage:
 *   php scripts/import_communes.php /chemin/communes.csv
 *
 * CSV attendu (délimiteur ; ou ,) avec au minimum: nom
 * Colonnes acceptées (exemples): NOM, NOM_COMMUNE, LIBELLE, CODE_POSTAL, INSEE
 */

declare(strict_types=1);

function slugify(string $s): string {
  $s = mb_strtolower($s);
  $s = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $s);
  $s = preg_replace('/[^a-z0-9]+/','-', $s);
  $s = trim($s,'-');
  return $s ?: 'ville';
}

$input = $argv[1] ?? '';
if ($input === '' || !is_file($input)) {
  fwrite(STDERR, "Fichier CSV requis. Usage: php scripts/import_communes.php communes.csv
");
  exit(1);
}

$raw = file($input, FILE_IGNORE_NEW_LINES);
if (!$raw) exit(1);

$delim = (substr_count($raw[0], ';') > substr_count($raw[0], ',')) ? ';' : ',';
$header = str_getcsv(array_shift($raw), $delim);
$norm = array_map(fn($h) => strtoupper(trim($h)), $header);

$idxName = array_search('NOM', $norm);
if ($idxName === false) $idxName = array_search('NOM_COMMUNE', $norm);
if ($idxName === false) $idxName = array_search('LIBELLE', $norm);

$idxCp = array_search('CODE_POSTAL', $norm);
if ($idxCp === false) $idxCp = array_search('CP', $norm);

$idxInsee = array_search('INSEE', $norm);
if ($idxInsee === false) $idxInsee = array_search('CODE_INSEE', $norm);

if ($idxName === false) {
  fwrite(STDERR, "Colonne nom introuvable. Colonnes: " . implode(',', $norm) . "
");
  exit(1);
}

$out = [];
$seen = [];
foreach ($raw as $line) {
  if (trim($line) === '') continue;
  $row = str_getcsv($line, $delim);
  $name = trim((string)($row[$idxName] ?? ''));
  if ($name === '') continue;

  $cp = $idxCp !== false ? trim((string)($row[$idxCp] ?? '')) : '';
  $insee = $idxInsee !== false ? trim((string)($row[$idxInsee] ?? '')) : '';

  $slug = slugify($name);
  $base = $slug;
  $i = 2;
  while (isset($seen[$slug])) { $slug = $base . '-' . $i; $i++; }
  $seen[$slug] = true;

  $out[] = [
    'name' => $name,
    'slug' => $slug,
    'postal_code' => $cp,
    'postal_codes' => $cp ? [$cp] : [],
    'insee' => $insee,
  ];
}

file_put_contents(__DIR__ . '/../data/communes.json', json_encode($out, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));

echo "OK: " . count($out) . " communes importées dans data/communes.json
";
