<?php
$phone = $config['phone'] ?? '';
$mainCities = $config['main_cities'] ?? [];

$faq = [
  [
    'q' => 'Quel poêle à granulés choisir ?',
    'a' => 'Le choix dépend de votre surface à chauffer et de l\'isolation de votre maison. Pour une surface de 80-100m², un poêle de 8-10 kW suffit. Pour plus de 120m², optez pour un modèle de 12-14 kW ou une chaudière à granulés. Nous installons les marques Premium : MCZ, Palazzetti, Ravelli, Extraflame.'
  ],
  [
    'q' => 'Quel prix pour un poêle à granulés installé ?',
    'a' => 'Un poêle à granulés coûte entre 3 000€ et 8 000€ TTC posé, selon la puissance et les options (ventilation, thermostat, programmation). Avec les aides MaPrimeRénov\' et CEE, vous pouvez bénéficier jusqu\'à 2 500€ d\'aide.'
  ],
  [
    'q' => 'Les granulés sont-ils chers ?',
    'a' => 'Le coût des granulés est très stable (environ 300-350€/tonne). Un poêle à granulés de 10 kW consomme environ 2 tonnes par an pour une maison de 100m², soit 600-700€/an, bien moins cher que le fioul ou l\'électricité.'
  ],
  [
    'q' => 'Un poêle à granulés est-il autonome ?',
    'a' => 'Oui ! Le poêle à granulés est totalement autonome avec un réservoir de 15 à 25 kg qui dure 1 à 3 jours selon l\'utilisation. Il s\'allume et s\'éteint automatiquement selon la programmation. Il nécessite juste une prise électrique et un conduit d\'évacuation des fumées.'
  ],
];

$benefits = [
  ['icon' => '🌿', 'title' => '100% renouvelable', 'desc' => 'Énergie bois locale et écologique'],
  ['icon' => '💰', 'title' => 'Coût stable', 'desc' => 'Prix des granulés stable dans le temps'],
  ['icon' => '🏠', 'title' => 'Ambiance chaleureuse', 'desc' => 'Flamme visible et chaleur douce'],
  ['icon' => '🔥', 'title' => 'Autonomie', 'desc' => 'Fonctionnement autonome programmable'],
];

$steps = [
  ['number' => '1', 'icon' => '📐', 'title' => 'Dimensionnement', 'desc' => 'Calcul de la puissance nécessaire'],
  ['number' => '2', 'icon' => '🎯', 'title' => 'Choix du modèle', 'desc' => 'Sélection selon vos critères'],
  ['number' => '3', 'icon' => '🔧', 'title' => 'Installation', 'desc' => 'Pose et raccordement'],
  ['number' => '4', 'icon' => '✅', 'title' => 'Mise en service', 'desc' => 'Test et formation d\'utilisation'],
];

$popularCities = array_slice($mainCities, 0, 6, true);
?>

<nav class="breadcrumbs">
  <a href="/">Accueil</a>
  <span>›</span>
  <a href="/chauffage/poele-granules">Poêle à Granulés</a>
</nav>

<section class="service-hero">
  <div class="container">
    <div class="service-hero__grid">
      <div class="service-hero__content">
        <div class="service-hero__badge">🌿 Chauffage écologique 100% bois</div>
        <h1 class="service-hero__title">
          Installation<br>
          <span class="gradient-text">Poêle à Granulés</span>
        </h1>
        <p class="service-hero__desc">
          Poêle et chaudière à granulés de bois dans les Vosges. Chauffage 100% renouvelable, 
          coût du combustible stable, ambiance chaleureuse. Marques Premium MCZ, Palazzetti. 
          Aides MaPrimeRénov' jusqu'à 2 500€.
        </p>
        <div class="service-hero__actions">
          <a href="/contact?service=Poêle à Granulés" class="btn btn--primary btn--large">
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
          <span class="service-visual-card__icon">🌿</span>
          <h3>Poêle à Granulés</h3>
          <p>Chauffage écologique</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section--alt">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Écologique</span>
      <h2 class="section-title">Pourquoi choisir le <span class="gradient-text">granulés</span> ?</h2>
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
      <h2 class="section-title">Installation <span class="gradient-text">en 4 étapes</span></h2>
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
        <h3>💰 Aides pour le chauffage bois</h3>
        <p>Le poêle à granulés est fortement encouragé par l'État :</p>
        <div class="aides-box__list">
          <span class="aide-tag">MaPrimeRénov' jusqu'à 2 500€</span>
          <span class="aide-tag">Prime Énergie CEE</span>
          <span class="aide-tag">TVA 5.5%</span>
          <span class="aide-tag">Aide locale départementale</span>
        </div>
      </div>
      <a href="/contact?service=Poêle à Granulés" class="btn btn--primary">Calculer mes aides</a>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Intervention</span>
      <h2 class="section-title">Installation granulés dans les <span class="gradient-text">Vosges</span></h2>
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
            <p class="city-card__desc">Poêle granulés <?= e($city['name']) ?></p>
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
      <h2 class="section-title">Questions sur le <span class="gradient-text">poêle à granulés</span></h2>
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
      <h2>Devis poêle à granulés gratuit</h2>
      <p class="lead">Chauffage écologique 100% bois, aides jusqu'à 2 500€. Marques Premium.</p>
    </div>
    <div class="final-cta__actions">
      <a href="/contact?service=Poêle à Granulés" class="btn btn--primary btn--large">📋 Demander un devis</a>
    </div>
  </div>
</section>

<section class="phone-cta-section">
  <div class="container">
    <div class="phone-cta-box">
      <span class="phone-cta-box__icon">📞</span>
      <h2 class="phone-cta-box__title">Conseil poêle à granulés</h2>
      <p class="phone-cta-box__subtitle">Quelle puissance pour votre maison ?</p>
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
  "name": "Installation Poêle à Granulés Vosges",
  "description": "Installation poêle et chaudière à granulés de bois dans les Vosges. Chauffage 100% renouvelable, MaPrimeRénov' jusqu'à 2 500€.",
  "provider": {
    "@type": "LocalBusiness",
    "name": "Chauffage-Vosges"
  },
  "areaServed": "Vosges (88)"
}
</script>
