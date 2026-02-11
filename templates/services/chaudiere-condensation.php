<?php
$phone = $config['phone'] ?? '';
$mainCities = $config['main_cities'] ?? [];

$faq = [
  [
    'q' => 'Qu\'est-ce qu\'une chaudière à condensation ?',
    'a' => 'Une chaudière à condensation récupère la chaleur contenue dans les fumées d\'évacuation (vapeur d\'eau) pour la réinjecter dans le circuit de chauffage. Cette technologie permet d\'atteindre un rendement de 109%, soit 30% d\'économies par rapport à une chaudière ancienne.'
  ],
  [
    'q' => 'Quelles économies avec une chaudière condensation ?',
    'a' => 'Vous pouvez économiser jusqu\'à 30% sur votre facture de chauffage. Une chaudière à condensation coûte plus cher à l\'achat mais s\'amortit en 5 à 7 ans grâce aux économies réalisées et aux aides de l\'État (MaPrimeRénov\' jusqu\'à 2 500€).'
  ],
  [
    'q' => 'La condensation est-elle adaptée aux Vosges ?',
    'a' => 'Oui ! Malgré les hivers froids dans les Vosges, la chaudière à condensation fonctionne très bien. Elle est particulièrement efficace dans les maisons bien isolées et peut fonctionner avec des températures de retour basses (plancher chauffant ou gros radiateurs).'
  ],
  [
    'q' => 'Quelle est la durée de vie d\'une chaudière condensation ?',
    'a' => 'Une chaudière à condensation bien entretenue dure en moyenne 15 ans. L\'entretien annuel est obligatoire et essentiel pour garantir son efficacité et sa longévité.'
  ],
];

$benefits = [
  ['icon' => '📈', 'title' => 'Rendement 109%', 'desc' => 'La technologie la plus performante du marché'],
  ['icon' => '💰', 'title' => 'Économies 30%', 'desc' => 'Jusqu\'à 30% d\'économies sur votre facture'],
  ['icon' => '🌱', 'title' => 'Écologique', 'desc' => 'Réduction significative des émissions de CO2'],
  ['icon' => '🎁', 'title' => 'Aides maximum', 'desc' => 'Éligible à toutes les aides de l\'État'],
];

$steps = [
  ['number' => '1', 'icon' => '🏠', 'title' => 'Audit énergétique', 'desc' => 'Évaluation de votre isolation et besoins'],
  ['number' => '2', 'icon' => '📋', 'title' => 'Devis avec aides', 'desc' => 'Calcul de MaPrimeRénov\' et CEE'],
  ['number' => '3', 'icon' => '🔧', 'title' => 'Installation', 'desc' => 'Pose certifiée RGE QualiPAC'],
  ['number' => '4', 'icon' => '📊', 'title' => 'Suivi', 'desc' => 'Optimisation des réglages'],
];

$popularCities = array_slice($mainCities, 0, 6, true);
?>

<nav class="breadcrumbs">
  <a href="/">Accueil</a>
  <span>›</span>
  <a href="/chauffage/chaudiere-condensation">Chaudière Condensation</a>
</nav>

<section class="service-hero">
  <div class="container">
    <div class="service-hero__grid">
      <div class="service-hero__content">
        <div class="service-hero__badge">💧 Haute performance énergétique</div>
        <h1 class="service-hero__title">
          Chaudière à<br>
          <span class="gradient-text">Condensation</span>
        </h1>
        <p class="service-hero__desc">
          La technologie de chauffage la plus performante avec un rendement de 109%. 
          Jusqu'à 30% d'économies sur votre facture, éligible à MaPrimeRénov' jusqu'à 2 500€. 
          Installation certifiée RGE dans les Vosges.
        </p>
        <div class="service-hero__actions">
          <a href="/contact?service=Chaudière Condensation" class="btn btn--primary btn--large">
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
          <span class="service-visual-card__icon">💧</span>
          <h3>Condensation</h3>
          <p>Rendement 109%</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section--alt">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Performance</span>
      <h2 class="section-title">Pourquoi choisir la <span class="gradient-text">condensation</span> ?</h2>
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

<section class="section">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Installation</span>
      <h2 class="section-title">Notre expertise <span class="gradient-text">RGE QualiPAC</span></h2>
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

<section class="section section--alt">
  <div class="container">
    <div class="aides-box">
      <div class="aides-box__content">
        <h3>💰 Aides MaPrimeRénov' 2025</h3>
        <p>En tant qu'installateur RGE QualiPAC, vous bénéficiez des aides maximales :</p>
        <div class="aides-box__list">
          <span class="aide-tag">MaPrimeRénov' jusqu'à 2 500€</span>
          <span class="aide-tag">Prime Énergie CEE</span>
          <span class="aide-tag">TVA 5.5%</span>
          <span class="aide-tag">Éco-PTZ</span>
        </div>
      </div>
      <a href="/contact?service=Chaudière Condensation" class="btn btn--primary">Calculer mes aides</a>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Intervention</span>
      <h2 class="section-title">Installation dans les <span class="gradient-text">Vosges</span></h2>
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
            <p class="city-card__desc">Condensation <?= e($city['name']) ?></p>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section--alt">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">FAQ</span>
      <h2 class="section-title">Questions sur la <span class="gradient-text">condensation</span></h2>
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

<section class="section">
  <div class="final-cta">
    <div class="final-cta__content">
      <h2>Devis chaudière condensation gratuit</h2>
      <p class="lead">Rendement 109%, jusqu'à 2 500€ d'aides. Installation RGE QualiPAC.</p>
    </div>
    <div class="final-cta__actions">
      <a href="/contact?service=Chaudière Condensation" class="btn btn--primary btn--large">📋 Demander un devis</a>
    </div>
  </div>
</section>

<section class="phone-cta-section">
  <div class="container">
    <div class="phone-cta-box">
      <span class="phone-cta-box__icon">📞</span>
      <h2 class="phone-cta-box__title">Besoin de conseils ?</h2>
      <p class="phone-cta-box__subtitle">Nos experts vous guident</p>
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

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Installation Chaudière Condensation Vosges",
  "description": "Installation chaudière à condensation dans les Vosges. Rendement 109%, MaPrimeRénov jusqu'à 2 500€. Installateur RGE QualiPAC.",
  "provider": {
    "@type": "LocalBusiness",
    "name": "Chauffage-Vosges"
  },
  "areaServed": "Vosges (88)"
}
</script>
