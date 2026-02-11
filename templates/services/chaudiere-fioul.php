<?php
$phone = $config['phone'] ?? '';
$mainCities = $config['main_cities'] ?? [];

$faq = [
  [
    'q' => 'Faut-il remplacer sa chaudière fioul ?',
    'a' => 'Si votre chaudière fioul a plus de 15 ans, qu\'elle tombe souvent en panne ou que votre facture de fioul augmente, il est temps de la remplacer. La conversion vers le gaz naturel permet d\'économiser jusqu\'à 40% sur votre facture énergétique.'
  ],
  [
    'q' => 'Peut-on convertir du fioul au gaz ?',
    'a' => 'Oui ! La conversion fioul vers gaz est très avantageuse : plus besoin de livraisons de fioul, pas d\'odeur, économies de 30 à 40%, et accès aux aides de l\'État. Nous vérifions la faisabilité du raccordement au réseau gaz dans votre commune.'
  ],
  [
    'q' => 'Quel coût pour remplacer une chaudière fioul ?',
    'a' => 'Le remplacement d\'une chaudière fioul par une chaudière gaz à condensation coûte entre 5 000€ et 10 000€ selon les travaux nécessaires. Cependant, avec MaPrimeRénov\' (jusqu\'à 2 500€) + CEE + TVA 5.5%, votre investissement est fortement réduit.'
  ],
  [
    'q' => 'L\'entretien chaudière fioul est-il obligatoire ?',
    'a' => 'Oui, depuis 2010, l\'entretien annuel des chaudières fioul est obligatoire. Cet entretien comprend le nettoyage, les réglages, les contrôles de sécurité et le ramonage du conduit d\'évacuation. Prix à partir de 180€ TTC.'
  ],
];

$benefits = [
  ['icon' => '💰', 'title' => 'Économies 40%', 'desc' => 'Jusqu\'à 40% d\'économies en convertissant au gaz'],
  ['icon' => '👃', 'title' => 'Plus d\'odeur', 'desc' => 'Finies les odeurs de fioul dans votre maison'],
  ['icon' => '🚚', 'title' => 'Livraisons finies', 'desc' => 'Plus besoin de stocker et commander du fioul'],
  ['icon' => '🌱', 'title' => 'Écologique', 'desc' => 'Réduction importante des émissions polluantes'],
];

$steps = [
  ['number' => '1', 'icon' => '🔍', 'title' => 'Diagnostic', 'desc' => 'État de votre installation actuelle'],
  ['number' => '2', 'icon' => '💡', 'title' => 'Conseil', 'desc' => 'Fioul ou conversion gaz ?'],
  ['number' => '3', 'icon' => '🔧', 'title' => 'Installation', 'desc' => 'Remplacement ou conversion'],
  ['number' => '4', 'icon' => '✅', 'title' => 'Certification', 'desc' => 'Attestation et démarches'],
];

$popularCities = array_slice($mainCities, 0, 6, true);
?>

<nav class="breadcrumbs">
  <a href="/">Accueil</a>
  <span>›</span>
  <a href="/chauffage/chaudiere-fioul">Chaudière Fioul</a>
</nav>

<section class="service-hero">
  <div class="container">
    <div class="service-hero__grid">
      <div class="service-hero__content">
        <div class="service-hero__badge">🛢️ Remplacement & conversion gaz</div>
        <h1 class="service-hero__title">
          Chaudière<br>
          <span class="gradient-text">Fioul</span>
        </h1>
        <p class="service-hero__desc">
          Remplacement de votre chaudière fioul par une solution moderne dans les Vosges. 
          Conversion gaz naturel disponible avec économies jusqu'à 40%. Entretien annuel obligatoire. 
          Devis gratuit et aides MaPrimeRénov'.
        </p>
        <div class="service-hero__actions">
          <a href="/contact?service=Chaudière Fioul" class="btn btn--primary btn--large">
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
          <span class="service-visual-card__icon">🛢️</span>
          <h3>Chaudière Fioul</h3>
          <p>Conversion gaz disponible</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section--alt">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Conversion</span>
      <h2 class="section-title">Pourquoi remplacer le <span class="gradient-text">fioul</span> ?</h2>
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
      <h2 class="section-title">Conversion fioul <span class="gradient-text">en 4 étapes</span></h2>
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
        <h3>💰 Aides pour la conversion fioul</h3>
        <p>La conversion fioul vers gaz est fortement aidée :</p>
        <div class="aides-box__list">
          <span class="aide-tag">MaPrimeRénov' jusqu'à 2 500€</span>
          <span class="aide-tag">Prime Énergie CEE majorée</span>
          <span class="aide-tag">TVA 5.5%</span>
          <span class="aide-tag">Aide départementale possible</span>
        </div>
      </div>
      <a href="/contact?service=Chaudière Fioul" class="btn btn--primary">En savoir plus</a>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Intervention</span>
      <h2 class="section-title">Conversion fioul dans les <span class="gradient-text">Vosges</span></h2>
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
            <p class="city-card__desc">Conversion fioul <?= e($city['name']) ?></p>
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
      <h2 class="section-title">Questions sur la <span class="gradient-text">chaudière fioul</span></h2>
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
      <h2>Conversion fioul vers gaz gratuit</h2>
      <p class="lead">Économisez jusqu'à 40% sur votre facture. Devis sous 24h avec calcul des aides.</p>
    </div>
    <div class="final-cta__actions">
      <a href="/contact?service=Chaudière Fioul" class="btn btn--primary btn--large">📋 Demander un devis</a>
    </div>
  </div>
</section>

<section class="phone-cta-section">
  <div class="container">
    <div class="phone-cta-box">
      <span class="phone-cta-box__icon">📞</span>
      <h2 class="phone-cta-box__title">Conseil conversion fioul</h2>
      <p class="phone-cta-box__subtitle">Vérifiez l'éligibilité de votre commune</p>
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
  "name": "Remplacement Chaudière Fioul Vosges",
  "description": "Remplacement et conversion chaudière fioul vers gaz dans les Vosges. Économies jusqu'à 40%, MaPrimeRénov'.",
  "provider": {
    "@type": "LocalBusiness",
    "name": "Chauffage-Vosges"
  },
  "areaServed": "Vosges (88)"
}
</script>
