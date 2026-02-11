<?php
$phone = $config['phone'] ?? '';
$mainCities = $config['main_cities'] ?? [];

// FAQ spécifique Chaudière Gaz
$faq = [
  [
    'q' => 'Quel est le prix d\'une installation chaudière gaz dans les Vosges ?',
    'a' => 'Le prix d\'une installation de chaudière gaz varie de 3 000€ à 8 000€ TTC selon le type (murale ou sol), la puissance et les travaux nécessaires. Avec MaPrimeRénov\', vous pouvez bénéficier jusqu\'à 2 500€ d\'aide.'
  ],
  [
    'q' => 'Chaudière gaz naturel ou propane : que choisir ?',
    'a' => 'Le gaz naturel est idéal si vous êtes raccordé au réseau (zones urbaines). Le propane est parfait pour les zones rurales non raccordées. Nous vous conseillons selon votre situation géographique dans les Vosges.'
  ],
  [
    'q' => 'Quelle marque de chaudière gaz choisir ?',
    'a' => 'Nous installons toutes les grandes marques : Saunier Duval, Frisquet, Chaffoteaux, Atlantic, Viessmann, De Dietrich. Nous vous recommandons la meilleure marque selon votre budget et vos besoins.'
  ],
  [
    'q' => 'Quand remplacer une chaudière gaz ?',
    'a' => 'Une chaudière gaz a une durée de vie de 15 à 20 ans. Il est conseillé de la remplacer si elle a plus de 15 ans, si les pannes sont fréquentes, ou si votre facture énergétique augmente considérablement.'
  ],
  [
    'q' => 'L\'entretien annuel est-il obligatoire ?',
    'a' => 'Oui, depuis 2009, l\'entretien annuel des chaudières gaz est obligatoire. Cela garantit votre sécurité, prolonge la durée de vie de votre appareil et maintient son efficacité énergétique.'
  ],
];

// Avantages
$benefits = [
  ['icon' => '💰', 'title' => 'Économies garanties', 'desc' => 'Jusqu\'à 30% d\'économies sur votre facture avec une chaudière à condensation'],
  ['icon' => '🏆', 'title' => 'Installation certifiée', 'desc' => 'Installateur RGE QualiPAC, éligible aux aides de l\'État'],
  ['icon' => '⚡', 'title' => 'Intervention rapide', 'desc' => 'Devis sous 24h, installation en 1 à 2 jours selon les cas'],
  ['icon' => '🛡️', 'title' => 'Garantie décennale', 'desc' => 'Toutes nos installations sont couvertes par une assurance décennale'],
];

// Process
$steps = [
  ['number' => '1', 'icon' => '📞', 'title' => 'Diagnostic gratuit', 'desc' => 'Étude de votre installation et de vos besoins'],
  ['number' => '2', 'icon' => '📋', 'title' => 'Devis détaillé', 'desc' => 'Proposition personnalisée avec calcul des aides'],
  ['number' => '3', 'icon' => '🔧', 'title' => 'Installation', 'desc' => 'Pose professionnelle en 1 à 2 jours'],
  ['number' => '4', 'icon' => '✅', 'title' => 'Mise en service', 'desc' => 'Test complet et explications d\'utilisation'],
];

// Villes populaires
$popularCities = array_slice($mainCities, 0, 6, true);
?>

<nav class="breadcrumbs">
  <a href="/">Accueil</a>
  <span>›</span>
  <a href="/chauffage/chaudiere-gaz">Chaudière Gaz</a>
</nav>

<!-- Hero Section -->
<section class="service-hero">
  <div class="container">
    <div class="service-hero__grid">
      <div class="service-hero__content">
        <div class="service-hero__badge">🔥 Spécialiste chaudière gaz dans les Vosges</div>
        <h1 class="service-hero__title">
          Installation & Dépannage<br>
          <span class="gradient-text">Chaudière Gaz</span>
        </h1>
        <p class="service-hero__desc">
          Expert en chaudière gaz naturel et propane dans les Vosges (88). Installation neuve, 
          remplacement, entretien et réparation. Profitez de jusqu'à 30% d'économies et des aides 
          MaPrimeRénov' jusqu'à 2 500€.
        </p>
        <div class="service-hero__actions">
          <a href="/contact?service=Chaudière Gaz" class="btn btn--primary btn--large">
            📋 Devis Gratuit
          </a>
          <?php if ($phone): ?>
          <a href="tel:<?= e(preg_replace('/\s+/', '', $phone)) ?>" class="btn btn--secondary btn--large">
            📞 <?= e($phone) ?>
          </a>
          <?php endif; ?>
        </div>
      </div>
      <div class="service-hero__visual">
        <div class="service-visual-card">
          <span class="service-visual-card__icon">🔥</span>
          <h3>Chaudière Gaz</h3>
          <p>Installation & réparation dans les Vosges</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Avantages -->
<section class="section section--alt">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Avantages</span>
      <h2 class="section-title">Pourquoi choisir une <span class="gradient-text">chaudière gaz</span> ?</h2>
    </div>
    
    <div class="benefits-grid">
      <?php foreach ($benefits as $benefit): ?>
        <div class="benefit-card">
          <span class="benefit-card__icon" style="background: var(--primary-green);"><?= $benefit['icon'] ?></span>
          <div>
            <h3><?= e($benefit['title']) ?></h3>
            <p><?= e($benefit['desc']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Process -->
<section class="section">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Notre processus</span>
      <h2 class="section-title">Comment se déroule <span class="gradient-text">l'installation</span> ?</h2>
    </div>
    
    <div class="process-steps">
      <?php foreach ($steps as $step): ?>
        <div class="process-step">
          <div class="process-step__number"><?= $step['number'] ?></div>
          <div class="process-step__icon"><?= $step['icon'] ?></div>
          <h3 class="process-step__title"><?= e($step['title']) ?></h3>
          <p class="process-step__desc"><?= e($step['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Aides -->
<section class="section section--alt">
  <div class="container">
    <div class="aides-box">
      <div class="aides-box__content">
        <h3>💰 Aides et Subventions 2025</h3>
        <p>En tant qu'installateur RGE QualiPAC, nous vous accompagnons pour obtenir les aides de l'État :</p>
        <div class="aides-box__list">
          <span class="aide-tag">MaPrimeRénov' jusqu'à 2 500€</span>
          <span class="aide-tag">Prime Énergie CEE</span>
          <span class="aide-tag">TVA réduite 5.5%</span>
          <span class="aide-tag">Éco-PTZ</span>
        </div>
      </div>
      <a href="/contact?service=Chaudière Gaz" class="btn btn--primary">Calculer mes aides</a>
    </div>
  </div>
</section>

<!-- Villes -->
<section class="section">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Intervention</span>
      <h2 class="section-title">Installation chaudière gaz dans les <span class="gradient-text">Vosges</span></h2>
      <p class="section-desc">
        Nous intervenons dans tout le département des Vosges (88), notamment à Épinal, 
        Saint-Dié-des-Vosges, Rambervillers, et dans les communes environnantes.
      </p>
    </div>
    
    <div class="cities-grid">
      <?php foreach ($popularCities as $slug => $city): ?>
        <a href="/ville/<?= e($slug) ?>" class="city-card">
          <div class="city-card__visual">
            <span class="city-card__icon">🏘️</span>
            <span class="city-card__cp"><?= e($city['cp']) ?></span>
          </div>
          <div class="city-card__content">
            <h3 class="city-card__name"><?= e($city['name']) ?></h3>
            <p class="city-card__desc">Chaudière gaz <?= e($city['name']) ?></p>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="section section--alt">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">FAQ</span>
      <h2 class="section-title">Questions sur la <span class="gradient-text">chaudière gaz</span></h2>
    </div>
    
    <div class="faq-grid">
      <?php foreach ($faq as $item): ?>
        <details class="faq-item">
          <summary><?= e($item['q']) ?></summary>
          <div class="faq-item__content">
            <p><?= e($item['a']) ?></p>
          </div>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section">
  <div class="final-cta">
    <div class="final-cta__content">
      <h2>Besoin d'un devis pour votre chaudière gaz ?</h2>
      <p class="lead">Devis gratuit sous 24h. Installation certifiée RGE avec aides MaPrimeRénov'.</p>
    </div>
    <div class="final-cta__actions">
      <a href="/contact?service=Chaudière Gaz" class="btn btn--primary btn--large">📋 Demander un devis</a>
    </div>
  </div>
</section>

<!-- Section Téléphone -->
<section class="phone-cta-section">
  <div class="container">
    <div class="phone-cta-box">
      <span class="phone-cta-box__icon">📞</span>
      <h2 class="phone-cta-box__title">Une question sur la chaudière gaz ?</h2>
      <p class="phone-cta-box__subtitle">Nos experts vous conseillent par téléphone</p>
      <?php if ($phone): ?>
      <a href="tel:<?= e(preg_replace('/\s+/', '', $phone)) ?>" class="phone-cta-box__number">
        <span>📞</span> <?= e($phone) ?>
      </a>
      <?php endif; ?>
      <p class="phone-cta-box__hours">
        <strong>Horaires :</strong> Lun-Ven 7h30-19h · Sam 8h-17h<br>
        <span style="color: var(--primary-green);">Urgence : 7j/7</span>
      </p>
    </div>
  </div>
</section>

<!-- Schema.org -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Installation Chaudière Gaz Vosges",
  "description": "Installation et dépannage chaudière gaz naturel et propane dans les Vosges. Devis gratuit, éligible MaPrimeRénov'.",
  "provider": {
    "@type": "LocalBusiness",
    "name": "Chauffage-Vosges",
    "address": {
      "@type": "PostalAddress",
      "addressRegion": "Grand Est",
      "addressLocality": "Épinal",
      "postalCode": "88000"
    }
  },
  "areaServed": {
    "@type": "AdministrativeArea",
    "name": "Vosges (88)"
  }
}
</script>
