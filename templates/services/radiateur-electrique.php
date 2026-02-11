<?php
$phone = $config['phone'] ?? '';
$mainCities = $config['main_cities'] ?? [];

$faq = [
  [
    'q' => 'Quel radiateur électrique choisir ?',
    'a' => 'Nous recommandons les radiateurs à inertie (fluide ou sèche) qui offrent un confort optimal et des économies jusqu\'à 30% avec l\'option Heures Creuses. Les modèles connectés permettent un pilotage à distance et une programmation intelligente.'
  ],
  [
    'q' => 'Quel prix pour installer des radiateurs électriques ?',
    'a' => 'Un radiateur électrique à inertie coûte entre 400€ et 1 200€ selon la puissance et les options (connecté, design). L\'installation d\'un radiateur est rapide (2-3h) et sans travaux lourds. Pour une maison complète, compter 3 000€ à 8 000€.'
  ],
  [
    'q' => 'Les radiateurs électriques sont-ils économiques ?',
    'a' => 'Avec un contrat Heures Creuses et des radiateurs à inertie modernes, vous pouvez réduire votre facture de 20 à 30%. L\'inertie permet de chauffer pendant les heures creuses (moins chères) et de restituer la chaleur pendant les heures pleines.'
  ],
  [
    'q' => 'Quelle puissance par pièce ?',
    'a' => 'En général : 1 000W pour une chambre de 10m², 1 500W pour un salon de 15m², 2 000W pour une pièce de 20m². Nous réalisons un calcul thermique précis selon l\'isolation et l\'exposition de chaque pièce.'
  ],
];

$benefits = [
  ['icon' => '⚡', 'title' => 'Installation rapide', 'desc' => 'Pose en 2-3h sans travaux lourds'],
  ['icon' => '📱', 'title' => 'Pilotage connecté', 'desc' => 'Contrôle à distance via smartphone'],
  ['icon' => '💰', 'title' => 'Heures Creuses', 'desc' => 'Économies 30% avec option HC'],
  ['icon' => '🎨', 'title' => 'Design moderne', 'desc' => 'Esthétique contemporaine épurée'],
];

$steps = [
  ['number' => '1', 'icon' => '📐', 'title' => 'Calcul thermique', 'desc' => 'Puissance nécessaire par pièce'],
  ['number' => '2', 'icon' => '🎨', 'title' => 'Choix modèles', 'desc' => 'Design et options adaptés'],
  ['number' => '3', 'icon' => '⚡', 'title' => 'Installation', 'desc' => 'Pose rapide en 1 journée'],
  ['number' => '4', 'icon' => '📱', 'title' => 'Configuration', 'desc' => 'Programmation et connectique'],
];

$popularCities = array_slice($mainCities, 0, 6, true);
?>

<nav class="breadcrumbs">
  <a href="/">Accueil</a>
  <span>›</span>
  <a href="/chauffage/radiateur-electrique">Radiateur Électrique</a>
</nav>

<section class="service-hero">
  <div class="container">
    <div class="service-hero__grid">
      <div class="service-hero__content">
        <div class="service-hero__badge">🔌 Inertie et connecté</div>
        <h1 class="service-hero__title">
          Radiateur<br>
          <span class="gradient-text">Électrique</span>
        </h1>
        <p class="service-hero__desc">
          Installation de radiateurs électriques modernes dans les Vosges. Inertie fluide ou sèche, 
          modèles connectés et programmables. Économies jusqu'à 30% avec Heures Creuses. 
          Installation rapide sans travaux lourds.
        </p>
        <div class="service-hero__actions">
          <a href="/contact?service=Radiateur Électrique" class="btn btn--primary btn--large">
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
          <span class="service-visual-card__icon">🔌</span>
          <h3>Radiateur Électrique</h3>
          <p>Inertie & connecté</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section--alt">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Moderne</span>
      <h2 class="section-title">Pourquoi choisir le <span class="gradient-text">radiateur moderne</span> ?</h2>
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
        <h3>💰 Aides disponibles</h3>
        <p>Le remplacement de radiateurs peut bénéficier de :</p>
        <div class="aides-box__list">
          <span class="aide-tag">MaPrimeRénov' (cas particuliers)</span>
          <span class="aide-tag">Prime Énergie CEE</span>
          <span class="aide-tag">TVA 5.5%</span>
          <span class="aide-tag">Coup de pouce économies</span>
        </div>
      </div>
      <a href="/contact?service=Radiateur Électrique" class="btn btn--primary">En savoir plus</a>
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
            <p class="city-card__desc">Radiateur <?= e($city['name']) ?></p>
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
      <h2 class="section-title">Questions sur le <span class="gradient-text">radiateur électrique</span></h2>
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
      <h2>Devis radiateur électrique gratuit</h2>
      <p class="lead">Installation rapide en 1 journée, sans travaux lourds. Devis sous 24h.</p>
    </div>
    <div class="final-cta__actions">
      <a href="/contact?service=Radiateur Électrique" class="btn btn--primary btn--large">📋 Demander un devis</a>
    </div>
  </div>
</section>

<section class="phone-cta-section">
  <div class="container">
    <div class="phone-cta-box">
      <span class="phone-cta-box__icon">📞</span>
      <h2 class="phone-cta-box__title">Conseil radiateur</h2>
      <p class="phone-cta-box__subtitle">Quelle puissance pour chaque pièce ?</p>
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
  "name": "Installation Radiateur Électrique Vosges",
  "description": "Installation radiateurs électriques inertie et connectés dans les Vosges. Économies 30% avec Heures Creuses. Installation rapide.",
  "provider": {
    "@type": "LocalBusiness",
    "name": "Chauffage-Vosges"
  },
  "areaServed": "Vosges (88)"
}
</script>
