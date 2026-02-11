<?php
$phone = $config['phone'] ?? '';
$mainCities = $config['main_cities'] ?? [];

$faq = [
  [
    'q' => 'Quel prix pour un plancher chauffant ?',
    'a' => 'Un plancher chauffant coûte entre 80€ et 150€/m² TTC selon le type (hydraulique ou électrique) et si c\'est une construction neuve ou une rénovation. Pour une maison de 100m², compter 10 000€ à 20 000€ TTC, mais avec les aides MaPrimeRénov\', le coût réel est bien inférieur.'
  ],
  [
    'q' => 'Plancher chauffant hydraulique ou électrique ?',
    'a' => 'Le plancher hydraulique (eau) est plus économique à l\'usage et idéal avec une PAC ou chaudière. Le plancher électrique est moins cher à l\'installation mais coûte plus cher en consommation. Pour une construction neuve, nous recommandons le hydraulique couplé à une PAC.'
  ],
  [
    'q' => 'Peut-on installer un plancher chauffant en rénovation ?',
    'a' => 'Oui, mais cela dépend de la hauteur sous plafond disponible. En rénovation, nous proposons des solutions de plancher chauffant basse épaisseur (3-5 cm) ou des planchers muraux (murs chauffants) si la hauteur est insuffisante. Une étude technique est nécessaire.'
  ],
  [
    'q' => 'Le plancher chauffant est-il économique ?',
    'a' => 'Oui ! Le plancher chauffant offre un confort thermique optimal avec une température de fonctionnement basse (35-45°C contre 60-70°C pour des radiateurs). Cela permet d\'économiser 20 à 30% sur la facture de chauffage, surtout couplé à une PAC ou une chaudière à condensation.'
  ],
];

$benefits = [
  ['icon' => '🌡️', 'title' => 'Confort maximal', 'desc' => 'Chaleur homogène et douce dans toute la pièce'],
  ['icon' => '👁️', 'title' => 'Invisible', 'desc' => 'Aucun radiateur visible, gain de place'],
  ['icon' => '💰', 'title' => 'Économies 30%', 'desc' => 'Température basse = consommation réduite'],
  ['icon' => '❄️', 'title' => 'Rafraîchissant', 'desc' => 'Peut rafraîchir en été (eau froide)'],
];

$steps = [
  ['number' => '1', 'icon' => '📐', 'title' => 'Étude technique', 'desc' => 'Vérification faisabilité'],
  ['number' => '2', 'icon' => '📋', 'title' => 'Devis détaillé', 'desc' => 'Hydraulique ou électrique'],
  ['number' => '3', 'icon' => '🏗️', 'title' => 'Installation', 'desc' => 'Pose des tubes et chape'],
  ['number' => '4', 'icon' => '🔧', 'title' => 'Mise en service', 'desc' => 'Test et réglages'],
];

$popularCities = array_slice($mainCities, 0, 6, true);
?>

<nav class="breadcrumbs">
  <a href="/">Accueil</a>
  <span>›</span>
  <a href="/chauffage/plancher-chauffant">Plancher Chauffant</a>
</nav>

<section class="service-hero">
  <div class="container">
    <div class="service-hero__grid">
      <div class="service-hero__content">
        <div class="service-hero__badge">🏠 Confort optimal invisible</div>
        <h1 class="service-hero__title">
          Installation<br>
          <span class="gradient-text">Plancher Chauffant</span>
        </h1>
        <p class="service-hero__desc">
          Plancher chauffant hydraulique et électrique dans les Vosges. Confort thermique maximum, 
          chaleur homogène, invisible dans la maison. Compatible pompe à chaleur. 
          Économies jusqu'à 30%. Construction neuve ou rénovation.
        </p>
        <div class="service-hero__actions">
          <a href="/contact?service=Plancher Chauffant" class="btn btn--primary btn--large">
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
          <span class="service-visual-card__icon">🏠</span>
          <h3>Plancher Chauffant</h3>
          <p>Confort invisible</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section--alt">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Confort</span>
      <h2 class="section-title">Pourquoi choisir le <span class="gradient-text">plancher chauffant</span> ?</h2>
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
        <h3>💰 Aides pour le plancher chauffant</h3>
        <p>Le plancher chauffant est fortement encouragé :</p>
        <div class="aides-box__list">
          <span class="aide-tag">MaPrimeRénov' jusqu'à 5 000€</span>
          <span class="aide-tag">Prime Énergie CEE</span>
          <span class="aide-tag">TVA 5.5%</span>
          <span class="aide-tag">Éco-PTZ</span>
        </div>
      </div>
      <a href="/contact?service=Plancher Chauffant" class="btn btn--primary">Calculer mes aides</a>
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
            <p class="city-card__desc">Plancher chauffant <?= e($city['name']) ?></p>
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
      <h2 class="section-title">Questions sur le <span class="gradient-text">plancher chauffant</span></h2>
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
      <h2>Devis plancher chauffant gratuit</h2>
      <p class="lead">Confort optimal invisible, économies 30%. Neuf ou rénovation.</p>
    </div>
    <div class="final-cta__actions">
      <a href="/contact?service=Plancher Chauffant" class="btn btn--primary btn--large">📋 Demander un devis</a>
    </div>
  </div>
</section>

<section class="phone-cta-section">
  <div class="container">
    <div class="phone-cta-box">
      <span class="phone-cta-box__icon">📞</span>
      <h2 class="phone-cta-box__title">Étude technique gratuite</h2>
      <p class="phone-cta-box__subtitle">Vérifiez la faisabilité chez vous</p>
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
  "name": "Installation Plancher Chauffant Vosges",
  "description": "Installation plancher chauffant hydraulique et électrique dans les Vosges. Confort optimal, économies 30%, compatible PAC. Neuf et rénovation.",
  "provider": {
    "@type": "LocalBusiness",
    "name": "Chauffage-Vosges"
  },
  "areaServed": "Vosges (88)"
}
</script>
