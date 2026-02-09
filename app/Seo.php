<?php
namespace App;

final class Seo {
  public static function forHome(array $config): array {
    $googleReviews = $config['reviews']['google'] ?? ['rating' => 4.9, 'count' => 56];
    $title = "LUC Didier - Chauffagiste RGE à Padoux | Épinal, Rambervillers, Thaon (88)";
    $desc = "Chauffagiste RGE QualiPAC, électricien, plombier & antenniste à Padoux. Intervention Épinal, Rambervillers, Thaon-les-Vosges, Bruyères. {$googleReviews['rating']}/5 Google ({$googleReviews['count']} avis). Devis gratuit.";
    return self::base($config, $title, $desc, rtrim($config['base_url'],'/') . '/');
  }

  public static function forCommunesHub(array $config): array {
    $title = "Zones d'intervention | LUC Didier - Artisan des Vosges (88)";
    $desc = "LUC Didier intervient à Épinal, Rambervillers, Thaon-les-Vosges, Bruyères, Padoux et communes voisines. Chauffage, plomberie, électricité, antenne.";
    return self::base($config, $title, $desc, rtrim($config['base_url'],'/') . '/communes');
  }

  public static function forCommunesLetter(array $config, string $letter): array {
    $title = "Communes Vosges {$letter} | LUC Didier - Chauffagiste RGE";
    $desc = "Liste des communes des Vosges (88) commençant par {$letter}. Intervention LUC Didier sur tout le département. Chauffage, plomberie, électricité.";
    return self::base($config, $title, $desc, rtrim($config['base_url'],'/') . '/communes/' . strtolower($letter));
  }

  public static function forCity(array $config, array $commune): array {
    $name = $commune['name'] ?? 'Votre ville';
    $cp = $commune['cp'] ?? '';
    $googleReviews = $config['reviews']['google'] ?? ['rating' => 4.9, 'count' => 56];
    
    $title = "LUC Didier {$name}" . ($cp ? " ({$cp})" : "") . " | Chauffagiste RGE & Plombier";
    $desc = "Chauffagiste RGE QualiPAC, plombier, électricien et antenniste à {$name}" . ($cp ? " ({$cp})" : "") . ". Basé à Padoux. {$googleReviews['rating']}/5. Devis gratuit.";
    $url = rtrim($config['base_url'], '/') . '/ville/' . ($commune['slug'] ?? '');
    return self::base($config, $title, $desc, $url);
  }

  public static function forContact(array $config): array {
    $title = "Contact & Devis | LUC Didier - Chauffagiste RGE Padoux (88)";
    $desc = "Contactez LUC Didier, chauffagiste RGE à Padoux. Devis gratuit sous 24h. Intervention Épinal, Rambervillers, Thaon-les-Vosges, Bruyères. 03 29 65 87 55.";
    return self::base($config, $title, $desc, rtrim($config['base_url'],'/') . '/contact');
  }

  public static function forStatic(array $config, string $page): array {
    $map = [
      'mentions' => [
        'Mentions légales | LUC Didier - Padoux (88)',
        'Informations légales : SIRET, adresse 3 Rte de Bult 88700 Padoux, certifications RGE QualiPAC et Qualibat.'
      ],
      'privacy' => [
        'Politique de confidentialité | LUC Didier',
        'Protection de vos données personnelles. Conformité RGPD et vos droits (accès, rectification, suppression).'
      ],
      'cgu' => [
        'CGU | LUC Didier - Artisan des Vosges',
        'Conditions d\'utilisation du site et limitations de responsabilité. Propriété intellectuelle.'
      ],
    ];
    [$t,$d] = $map[$page] ?? ['Informations | LUC Didier', 'Informations légales et conditions d\'utilisation.'];
    $path = $page === 'mentions' ? 'mentions-legales' : ($page === 'privacy' ? 'politique-confidentialite' : $page);
    return self::base($config, $t, $d, rtrim($config['base_url'],'/') . '/' . $path);
  }

  public static function for404(array $config): array {
    return self::base($config, "Page introuvable | LUC Didier", "La page demandée est introuvable. Retrouvez tous nos services sur Épinal, Rambervillers, Thaon-les-Vosges, Bruyères et Padoux.", rtrim($config['base_url'],'/') . '/404');
  }

  private static function base(array $config, string $title, string $desc, string $url): array {
    return [
      'title' => $title,
      'description' => $desc,
      'url' => $url,
      'site_name' => $config['site_name'] ?? $config['brand'] ?? 'Site',
      'brand' => $config['brand'] ?? 'Entreprise',
      'phone' => $config['phone'] ?? '',
    ];
  }
}
