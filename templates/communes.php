<?php
use App\Data;

$heatingServices = $config['heating_services'] ?? [];

// Coordonnées pour la carte des Vosges
$mapCities = [
  ['name' => 'Épinal', 'lat' => 48.1735, 'lng' => 6.4492],
  ['name' => 'Saint-Dié', 'lat' => 48.2855, 'lng' => 6.9479],
  ['name' => 'Rambervillers', 'lat' => 48.3456, 'lng' => 6.6346],
  ['name' => 'Thaon-les-Vosges', 'lat' => 48.2514, 'lng' => 6.4197],
  ['name' => 'Bruyères', 'lat' => 48.2083, 'lng' => 6.7194],
  ['name' => 'Golbey', 'lat' => 48.1944, 'lng' => 6.4306],
];

$topCities = Data::topByPopulation(12);
?>

<nav class="breadcrumbs">
  <a href="/">Accueil</a><span>›</span><span>Zones d'intervention</span>
</nav>

<section class="section section--communes">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">📍 Zones</span>
      <h1 class="section-title">Intervention dans tout le <span class="gradient-text">département des Vosges</span></h1>
      <p class="section-desc">
        Nous intervenons sur l'ensemble des 515 communes des Vosges (88). 
        Trouvez votre ville pour accéder à une page dédiée avec nos services.
      </p>
    </div>

    <!-- Map -->
    <div class="communes-map">
      <div id="vosges-map-full" class="interactive-map"></div>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var map = L.map('vosges-map-full').setView([48.25, 6.5], 9);
          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
          }).addTo(map);
          
          var cities = <?= json_encode($mapCities) ?>;
          cities.forEach(function(city) {
            L.marker([city.lat, city.lng])
              .addTo(map)
              .bindPopup('<b>' + city.name + '</b><br><a href="/ville/' + city.name.toLowerCase().replace(/ /g, '-') + '">Voir la page</a>');
          });
        });
      </script>
    </div>

    <!-- Navigation A-Z -->
    <div class="section-header section-header--center">
      <span class="section-tag">🗂️</span>
      <h2 class="section-title">Parcourir par <span class="gradient-text">lettre</span></h2>
    </div>

    <div class="az-nav">
      <?php foreach (array_keys($index ?? []) as $letter): ?>
        <?php if ($letter === '#') continue; ?>
        <a class="az-nav__link" href="/communes/<?= strtolower(e($letter)) ?>"><?= e($letter) ?></a>
      <?php endforeach; ?>
    </div>

    <!-- Top Cities -->
    <div class="section-header">
      <span class="section-tag">🏆</span>
      <h2 class="section-title">Villes <span class="gradient-text">principales</span></h2>
    </div>

    <div class="communes-grid">
      <?php foreach ($topCities as $c): ?>
        <a class="commune-card" href="/ville/<?= e($c['slug']) ?>">
          <span class="commune-card__icon">🏘️</span>
          <div class="commune-card__info">
            <div class="commune-card__name"><?= e($c['name']) ?></div>
            <div class="commune-card__meta"><?= e($c['cp'] ?? '88') ?><?= !empty($c['population']) ? ' • ' . number_format((int)$c['population'], 0, ',', ' ') . ' hab.' : '' ?></div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>

    <!-- Services Heating Links -->
    <div class="section-header" style="margin-top: 3rem;">
      <span class="section-tag">🔥</span>
      <h2 class="section-title">Nos solutions <span class="gradient-text">chauffage</span></h2>
    </div>

    <div class="services-grid" style="margin-bottom: 3rem;">
      <?php foreach ($heatingServices as $service): ?>
        <a href="/chauffage/<?= e($service['slug']) ?>" class="service-card" style="--service-color: <?= $service['color'] ?>">
          <div class="service-card__icon" style="background: <?= $service['color'] ?>20; color: <?= $service['color'] ?>">
            <?= $service['icon'] ?>
          </div>
          <h3 class="service-card__title"><?= e($service['title']) ?></h3>
          <p class="service-card__desc"><?= e($service['description']) ?></p>
        </a>
      <?php endforeach; ?>
    </div>

    <!-- Index Letters -->
    <div class="section-header">
      <span class="section-tag">📋</span>
      <h2 class="section-title">Index <span class="gradient-text">complet A-Z</span></h2>
    </div>

    <div class="grid grid--4" style="gap: 1rem;">
      <?php foreach ($index as $letter => $list): ?>
        <?php if ($letter === '#') continue; ?>
        <a class="panel panel--clickable" href="/communes/<?= strtolower(e($letter)) ?>">
          <div style="display: flex; align-items: center; gap: 1rem;">
            <span style="font-size: 1.5rem; font-weight: 800; color: var(--color-primary);"><?= e($letter) ?></span>
            <div>
              <strong><?= e($letter) ?></strong>
              <p class="muted" style="font-size: 0.875rem; margin: 0;"><?= count($list) ?> commune<?= count($list) > 1 ? 's' : '' ?></p>
            </div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php $phone = $config['phone'] ?? ''; ?>

<!-- CTA Centré -->
<section class="section">
  <div class="final-cta">
    <div class="final-cta__content">
      <h2>Vous ne trouvez pas votre commune ?</h2>
      <p class="lead">Contactez-nous ! Nous intervenons sur tout le département des Vosges.</p>
    </div>
    <div class="final-cta__actions">
      <a href="/contact" class="btn btn--primary btn--large">📋 Nous contacter</a>
    </div>
  </div>
</section>

<!-- Section Téléphone Centrée -->
<section class="phone-cta-section">
  <div class="container">
    <div class="phone-cta-box">
      <span class="phone-cta-box__icon">📞</span>
      <h2 class="phone-cta-box__title">Préférez nous appeler ?</h2>
      <p class="phone-cta-box__subtitle">Pour les urgences ou demandes rapides</p>
      <?php if ($phone): ?>
      <a href="tel:<?= e(preg_replace('/\s+/', '', $phone)) ?>" class="phone-cta-box__number">
        <span>📞</span> <?= e($phone) ?>
      </a>
      <?php endif; ?>
      <p class="phone-cta-box__hours">
        <strong>Horaires :</strong> Lun-Ven 7h30-19h00 · Sam 8h-17h<br>
        <span style="color: var(--color-primary-light);">Urgence : 7j/7</span>
      </p>
    </div>
  </div>
</section>
