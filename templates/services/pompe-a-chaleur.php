<?php
$phone = $config['phone'] ?? '';
$mainCities = $config['main_cities'] ?? [];

$faq = [
  [
    'q' => 'Quelle pompe à chaleur choisir dans les Vosges ?',
    'a' => 'Dans les Vosges, avec nos hivers froids (-10°C à -15°C), nous recommandons les PAC air/eau haute température adaptées au climat montagnard. Les modèles récents fonctionnent efficacement jusqu\'à -15°C. Nous installons des marques reconnues : Atlantic, Daikin, Mitsubishi, Panasonic.'
  ],
  [
    'q' => 'Quelles économies avec une PAC ?',
    'a' => 'Une pompe à chaleur permet d\'économiser jusqu\'à 70% sur votre facture de chauffage par rapport à une chaudière électrique, et jusqu\'à 40% par rapport au fioul ou gaz ancien. L\'amortissement se fait en 6 à 8 ans.'
  ],
  [
    'q' => 'Quelles aides pour une PAC en 2025 ?',
    'a' => 'La pompe à chaleur est l\'équipement le plus aidé : MaPrimeRénov\' jusqu\'à 5 000€, Prime Énergie CEE (1 000 à 4 000€), TVA 5.5%, Éco-PTZ. En cumul, les aides peuvent couvrir jusqu\'à 70% du coût total !'
  ],
  [
    'q' => 'La PAC fonctionne-t-elle par grand froid ?',
    'a' => 'Oui ! Les PAC modernes fonctionnent jusqu\'à -15°C, -20°C et même -25°C selon les modèles. Pour les zones très froides des Vosges, nous proposons des modèles haute température avec appoint électrique intégré pour les jours extrêmes.'
  ],
];

$benefits = [
  ['icon' => '💰', 'title' => 'Économies 70%', 'desc' => 'Jusqu\'à 70% d\'économies sur le chauffage'],
  ['icon' => '❄️', 'title' => 'Climatisation été', 'desc' => 'Rafraîchit votre maison l\'été'],
  ['icon' => '🌱', 'title' => '100% écologique', 'desc' => 'Utilise l\'énergie renouvelable de l\'air'],
  ['icon' => '🎁', 'title' => 'Aides record', 'desc' => 'Jusqu\'à 5 000€ de MaPrimeRénov\''],
];

$steps = [
  ['number' => '1', 'icon' => '🏠', 'title' => 'Étude thermique', 'desc' => 'Calcul des besoins de chauffage'],
  ['number' => '2', 'icon' => '📋', 'title' => 'Devis avec aides', 'desc' => 'MaPrimeRénov\' + CEE calculés'],
  ['number' => '3', 'icon' => '🔧', 'title' => 'Installation RGE', 'desc' => 'Pose certifiée en 2-3 jours'],
  ['number' => '4', 'icon' => '📊', 'title' => 'Optimisation', 'desc' => 'Réglages et suivi de performance'],
];

$popularCities = array_slice($mainCities, 0, 6, true);
?>

<nav class="breadcrumbs">
  <a href="/">Accueil</a>
  <span>›</span>
  <a href="/chauffage/pompe-a-chaleur">Pompe à Chaleur</a>
</nav>

<section class="service-hero">
  <div class="container">
    <div class="service-hero__grid">
      <div class="service-hero__content">
        <div class="service-hero__badge">🌱 Économies jusqu'à 70%</div>
        <h1 class="service-hero__title">
          Installation<br>
          <span class="gradient-text">Pompe à Chaleur</span>
        </h1>
        <p class="service-hero__desc">
          PAC air/eau et air/air dans les Vosges (88). Jusqu'à 70% d'économies sur votre chauffage, 
          fonctionne jusqu'à -15°C. MaPrimeRénov' jusqu'à 5 000€. Installation certifiée RGE QualiPAC.
        </p>
        <div class="service-hero__actions">
          <a href="/contact?service=Pompe à Chaleur" class="btn btn--primary btn--large">
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
          <span class="service-visual-card__icon">🌱</span>
          <h3>Pompe à Chaleur</h3>
          <p>Aides jusqu'à 5 000€</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section--alt">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Performance</span>
      <h2 class="section-title">Pourquoi choisir une <span class="gradient-text">PAC</span> ?</h2>
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
        <h3>💰 Aides record pour la PAC</h3>
        <p>La pompe à chaleur est l'équipement le plus aidé :</p>
        <div class="aides-box__list">
          <span class="aide-tag">MaPrimeRénov' jusqu'à 5 000€</span>
          <span class="aide-tag">Prime Énergie CEE</span>
          <span class="aide-tag">TVA 5.5%</span>
          <span class="aide-tag">Éco-PTZ</span>
        </div>
      </div>
      <a href="/contact?service=Pompe à Chaleur" class="btn btn--primary">Calculer mes aides</a>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Intervention</span>
      <h2 class="section-title">Installation PAC dans les <span class="gradient-text">Vosges</span></h2>
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
            <p class="city-card__desc">PAC <?= e($city['name']) ?></p>
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
      <h2 class="section-title">Questions sur la <span class="gradient-text">PAC</span></h2>
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
      <h2>Devis pompe à chaleur gratuit</h2>
      <p class="lead">Économies jusqu'à 70%, aides jusqu'à 5 000€. Installation RGE QualiPAC.</p>
    </div>
    <div class="final-cta__actions">
      <a href="/contact?service=Pompe à Chaleur" class="btn btn--primary btn--large">📋 Demander un devis</a>
    </div>
  </div>
</section>

<section class="phone-cta-section">
  <div class="container">
    <div class="phone-cta-box">
      <span class="phone-cta-box__icon">📞</span>
      <h2 class="phone-cta-box__title">Conseil PAC personnalisé</h2>
      <p class="phone-cta-box__subtitle">Quelle PAC pour votre maison ?</p>
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
  "name": "Installation Pompe à Chaleur Vosges",
  "description": "Installation PAC air/eau et air/air dans les Vosges. Économies jusqu'à 70%, MaPrimeRénov jusqu'à 5 000€. Installateur RGE QualiPAC.",
  "provider": {
    "@type": "LocalBusiness",
    "name": "Chauffage-Vosges"
  },
  "areaServed": "Vosges (88)"
}
</script>
