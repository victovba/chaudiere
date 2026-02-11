<?php
$phone = $config['phone'] ?? '';
$mainCities = $config['main_cities'] ?? [];

$faq = [
  [
    'q' => 'Quel est le prix d\'une installation chaudière électrique ?',
    'a' => 'Une chaudière électrique coûte entre 1 500€ et 4 000€ TTC selon la puissance (6 à 24 kW) et la marque. L\'installation est généralement plus rapide et moins coûteuse qu\'une chaudière gaz car pas de conduit de cheminée nécessaire.'
  ],
  [
    'q' => 'La chaudière électrique est-elle écologique ?',
    'a' => 'Oui ! La chaudière électrique est 100% écologique : zéro émission de CO2 sur place, pas de combustion, pas d\'odeur. Elle est idéale pour les maisons bien isolées et fonctionne parfaitement avec un contrat Heures Creuses pour optimiser les coûts.'
  ],
  [
    'q' => 'Quelle puissance pour une chaudière électrique ?',
    'a' => 'La puissance dépend de la surface et de l\'isolation de votre logement : 6-8 kW pour un appartement, 9-12 kW pour une maison de 100m² bien isolée, 15-24 kW pour des surfaces plus importantes ou moins isolées. Nous réalisons un calcul thermique précis.'
  ],
  [
    'q' => 'Peut-on installer une chaudière électrique en remplacement ?',
    'a' => 'Absolument ! La chaudière électrique est parfaite pour remplacer une vieille chaudière gaz ou fioul, notamment si vous n\'avez pas de conduit de cheminée. L\'installation est rapide (1 journée) et sans travaux lourds.'
  ],
];

$benefits = [
  ['icon' => '🌱', 'title' => 'Zéro émission', 'desc' => 'Solution écologique sans combustion ni fumées'],
  ['icon' => '🔇', 'title' => 'Silencieuse', 'desc' => 'Fonctionnement silencieux et sans odeur'],
  ['icon' => '⚡', 'title' => 'Installation rapide', 'desc' => 'Pose en 1 journée, pas de conduit nécessaire'],
  ['icon' => '📉', 'title' => 'Tarif Heures Creuses', 'desc' => 'Optimisez votre consommation avec l\'option HC'],
];

$steps = [
  ['number' => '1', 'icon' => '🔌', 'title' => 'Étude électrique', 'desc' => 'Vérification de votre installation électrique'],
  ['number' => '2', 'icon' => '📋', 'title' => 'Devis détaillé', 'desc' => 'Choix de la puissance adaptée'],
  ['number' => '3', 'icon' => '⚡', 'title' => 'Installation', 'desc' => 'Pose rapide en 1 journée'],
  ['number' => '4', 'icon' => '✅', 'title' => 'Configuration', 'desc' => 'Réglages et mise en service'],
];

$popularCities = array_slice($mainCities, 0, 6, true);
?>

<nav class="breadcrumbs">
  <a href="/">Accueil</a>
  <span>›</span>
  <a href="/chauffage/chaudiere-electrique">Chaudière Électrique</a>
</nav>

<section class="service-hero">
  <div class="container">
    <div class="service-hero__grid">
      <div class="service-hero__content">
        <div class="service-hero__badge">⚡ Solution écologique sans conduit</div>
        <h1 class="service-hero__title">
          Installation<br>
          <span class="gradient-text">Chaudière Électrique</span>
        </h1>
        <p class="service-hero__desc">
          Solution de chauffage écologique et facile à installer dans les Vosges. 
          Zéro émission, pas de conduit de cheminée nécessaire, installation en 1 journée. 
          Idéale pour les maisons bien isolées.
        </p>
        <div class="service-hero__actions">
          <a href="/contact?service=Chaudière Électrique" class="btn btn--primary btn--large">
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
          <span class="service-visual-card__icon">⚡</span>
          <h3>Chaudière Électrique</h3>
          <p>Écologique & silencieuse</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section--alt">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Avantages</span>
      <h2 class="section-title">Pourquoi choisir une <span class="gradient-text">chaudière électrique</span> ?</h2>
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
      <span class="section-tag">Notre processus</span>
      <h2 class="section-title">Installation en <span class="gradient-text">4 étapes</span></h2>
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
        <h3>💰 Aides disponibles</h3>
        <p>Bien que moins aidée que le gaz, la chaudière électrique peut bénéficier de :</p>
        <div class="aides-box__list">
          <span class="aide-tag">TVA réduite 5.5%</span>
          <span class="aide-tag">Prime Énergie CEE</span>
          <span class="aide-tag">MaPrimeRénov' (cas particuliers)</span>
        </div>
      </div>
      <a href="/contact?service=Chaudière Électrique" class="btn btn--primary">En savoir plus</a>
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
            <p class="city-card__desc">Chaudière électrique <?= e($city['name']) ?></p>
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
      <h2 class="section-title">Questions sur la <span class="gradient-text">chaudière électrique</span></h2>
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
      <h2>Devis chaudière électrique gratuit</h2>
      <p class="lead">Installation en 1 journée, pas de conduit nécessaire. Devis sous 24h.</p>
    </div>
    <div class="final-cta__actions">
      <a href="/contact?service=Chaudière Électrique" class="btn btn--primary btn--large">📋 Demander un devis</a>
    </div>
  </div>
</section>

<section class="phone-cta-section">
  <div class="container">
    <div class="phone-cta-box">
      <span class="phone-cta-box__icon">📞</span>
      <h2 class="phone-cta-box__title">Conseil personnalisé</h2>
      <p class="phone-cta-box__subtitle">Nos experts vous aident à choisir</p>
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
  "name": "Installation Chaudière Électrique Vosges",
  "description": "Installation chaudière électrique dans les Vosges. Solution écologique, sans conduit, installation en 1 journée.",
  "provider": {
    "@type": "LocalBusiness",
    "name": "Chauffage-Vosges"
  },
  "areaServed": "Vosges (88)"
}
</script>
