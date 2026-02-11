<?php
$phone = $config['phone'] ?? '';
$heatingServices = $config['heating_services'] ?? [];
$mainCities = $config['main_cities'] ?? [];

// Stats pour hero
$stats = [
  ['number' => '15+', 'label' => 'Années d\'expertise', 'icon' => '🏆'],
  ['number' => '8', 'label' => 'Types de chauffage', 'icon' => '🔥'],
  ['number' => '24h', 'label' => 'Devis rapide', 'icon' => '⚡'],
  ['number' => '100%', 'label' => 'Devis gratuits', 'icon' => '📋'],
];

// Villes pour la carte
$mapCities = [
  ['name' => 'Épinal', 'lat' => 48.1735, 'lng' => 6.4492, 'cp' => '88000'],
  ['name' => 'Saint-Dié', 'lat' => 48.2855, 'lng' => 6.9479, 'cp' => '88100'],
  ['name' => 'Rambervillers', 'lat' => 48.3456, 'lng' => 6.6346, 'cp' => '88700'],
  ['name' => 'Thaon-les-Vosges', 'lat' => 48.2514, 'lng' => 6.4197, 'cp' => '88150'],
  ['name' => 'Bruyères', 'lat' => 48.2083, 'lng' => 6.7194, 'cp' => '88600'],
  ['name' => 'Golbey', 'lat' => 48.1944, 'lng' => 6.4306, 'cp' => '88190'],
];

// FAQ
$faq = [
  [
    'q' => 'Quelle chaudière choisir pour les Vosges ?',
    'a' => 'Dans les Vosges, avec des hivers pouvant atteindre -10°C à -15°C selon l\'altitude, nous recommandons la chaudière à condensation gaz pour le remplacement (économies 25-30%), la pompe à chaleur air/eau haute température pour les maisons bien isolées (économies 70%), ou le poêle à granulés comme appoint dans les maisons mal isolées. Nous étudions votre situation pour vous proposer la meilleure solution.'
  ],
  [
    'q' => 'Quelles aides pour changer ma chaudière en 2025 ?',
    'a' => 'En tant qu\'installateur RGE QualiPAC, nous vous accompagnons pour MaPrimeRénov\' (jusqu\'à 2 500€ pour une chaudière, jusqu\'à 5 000€ pour une PAC), la Prime Énergie CEE, la TVA réduite à 5.5%, et l\'Éco-PTZ. Nous calculons vos aides et les intégrons directement dans votre devis.'
  ],
  [
    'q' => 'Quel délai pour installer une chaudière ?',
    'a' => 'Le délai d\'installation dépend du type de travaux : remplacement simple (1 journée), changement de technologie fioul vers gaz (1-2 jours), installation pompe à chaleur (2-3 jours), plancher chauffant complet (3-5 jours). Nous planifions selon vos disponibilités.'
  ],
  [
    'q' => 'Intervenez-vous en urgence en plein hiver ?',
    'a' => 'Oui ! Nous proposons un service de dépannage urgent 7j/7 en saison de chauffe (octobre à avril) pour les pannes de chaudière, fuites d\'eau sur installation chauffage, plus de chauffage ni d\'eau chaude. Intervention rapide dans les 24h maximum dans tout le 88.'
  ],
];

// Avantages
$advantages = [
  ['icon' => '🏆', 'title' => 'Certifié RGE QualiPAC', 'desc' => 'Accès aux aides de l\'État MaPrimeRénov\' et CEE. Installation professionnelle garantie.'],
  ['icon' => '⚡', 'title' => 'Intervention rapide', 'desc' => 'Devis sous 24h, installation en 1 à 3 jours. Dépannage urgent 7j/7 en hiver.'],
  ['icon' => '📋', 'title' => 'Devis transparent', 'desc' => 'Devis gratuit et détaillé. Pas de surprise, pas de frais cachés. Prix compétitifs.'],
  ['icon' => '🛡️', 'title' => 'Garantie décennale', 'desc' => 'Toutes nos installations sont couvertes. SAV réactif et suivi personnalisé.'],
  ['icon' => '🏔️', 'title' => 'Expert Vosges', 'desc' => 'Spécialistes du climat vosgien : hivers froids, altitude, maisons anciennes.'],
  ['icon' => '💰', 'title' => 'Aides maximales', 'desc' => 'Nous calculons et déduisons toutes vos aides. Jusqu\'à 5 000€ de prime !'],
];

// Process
$process = [
  ['number' => '1', 'icon' => '📞', 'title' => 'Votre demande', 'desc' => 'Contactez-nous par téléphone ou formulaire'],
  ['number' => '2', 'icon' => '📋', 'title' => 'Devis gratuit', 'desc' => 'Étude personnalisée sous 24h avec aides'],
  ['number' => '3', 'icon' => '🔧', 'title' => 'Installation', 'desc' => 'Pose certifiée RGE selon vos disponibilités'],
  ['number' => '4', 'icon' => '✅', 'title' => 'Suivi garanti', 'desc' => 'Garantie décennale et SAV réactif'],
];

// Top 6 villes
$topCities = array_slice($mainCities, 0, 6, true);
?>

<!-- Hero Section -->
<section class="hero-home">
  <div class="hero-home__bg"></div>
  <div class="container">
    <div class="hero-home__grid">
      <div class="hero-home__content">
        <div class="hero-home__badge">
          <span>🏆</span>
          <span>Installateur RGE QualiPAC dans les Vosges (88)</span>
        </div>
        
        <h1 class="hero-home__title">
          Installation & dépannage<br>
          <span class="gradient-text">chauffage</span><br>
          dans les Vosges
        </h1>
        
        <p class="hero-home__lead">
          Expert en chaudière gaz, pompe à chaleur, poêle à granulés et plancher chauffant 
          dans les Vosges. Devis gratuit sous 24h, aides MaPrimeRénov' jusqu'à 5 000€.
        </p>
        
        <div class="hero-home__actions">
          <a href="/contact" class="btn btn--primary btn--large">
            <span>📋</span> Devis Gratuit
          </a>
          <?php if ($phone): ?>
          <a href="tel:<?= e(preg_replace('/\s+/', '', $phone)) ?>" class="btn btn--secondary btn--large">
            <span>📞</span> <?= e($phone) ?>
          </a>
          <?php endif; ?>
        </div>

        <!-- Stats -->
        <div class="hero-home__stats">
          <?php foreach ($stats as $stat): ?>
            <div class="hero-stat">
              <span class="hero-stat__icon"><?= $stat['icon'] ?></span>
              <span class="hero-stat__number"><?= $stat['number'] ?></span>
              <span class="hero-stat__label"><?= $stat['label'] ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="hero-home__visual">
        <div class="hero-visual">
          <div class="hero-visual__blob"></div>
          <div class="hero-visual__content">
            <span class="hero-visual__icon">🌿</span>
            <h3>Expert Chauffage</h3>
            <p>Installation & dépannage<br>dans les Vosges</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Services Section -->
<section class="section">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Nos Solutions</span>
      <h2 class="section-title">Tous les types de <span class="gradient-text">chauffage</span></h2>
      <p class="section-desc">Solutions adaptées à votre maison et votre budget dans les Vosges</p>
    </div>

    <div class="services-grid">
      <?php foreach ($heatingServices as $service): ?>
        <a href="/chauffage/<?= e($service['slug']) ?>" class="service-card">
          <div class="service-card__icon"><?= $service['icon'] ?></div>
          <h3 class="service-card__title"><?= e($service['title']) ?></h3>
          <p class="service-card__desc"><?= e($service['description']) ?></p>
          <span class="service-card__link">En savoir plus →</span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Avantages Section -->
<section class="section section--alt">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Pourquoi nous choisir</span>
      <h2 class="section-title">L'expertise chauffage dans les <span class="gradient-text">Vosges</span></h2>
    </div>

    <div class="why-grid">
      <?php foreach ($advantages as $adv): ?>
        <div class="why-card">
          <div class="why-card__icon"><?= $adv['icon'] ?></div>
          <h3 class="why-card__title"><?= e($adv['title']) ?></h3>
          <p class="why-card__desc"><?= e($adv['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Process Section -->
<section class="section">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Comment ça marche</span>
      <h2 class="section-title">Notre processus en <span class="gradient-text">4 étapes</span></h2>
    </div>

    <div class="process-steps">
      <?php foreach ($process as $step): ?>
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

<!-- Map Section -->
<section class="section section--alt">
  <div class="container">
    <div class="map-section">
      <div class="map-section__content">
        <span class="section-tag">📍 Intervention</span>
        <h2 class="section-title">Nous couvrons tout le <span class="gradient-text">département 88</span></h2>
        <p class="section-desc">
          Basés au cœur des Vosges, nous intervenons sur l'ensemble du département : 
          Épinal, Saint-Dié-des-Vosges, Rambervillers, Thaon-les-Vosges et toutes les communes.
        </p>
        
        <div class="map-cities">
          <?php foreach ($topCities as $slug => $city): ?>
            <a href="/ville/<?= e($slug) ?>" class="map-city">
              <span><?= e($city['name']) ?></span>
              <span><?= e($city['cp']) ?></span>
            </a>
          <?php endforeach; ?>
        </div>

        <a href="/communes" class="btn btn--primary">
          <span>🗺️</span> Voir toutes les communes
        </a>
      </div>

      <div class="map-section__map">
        <div id="vosges-map" class="interactive-map"></div>
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('vosges-map').setView([48.25, 6.5], 9);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: '© OpenStreetMap'
            }).addTo(map);
            
            var cities = <?= json_encode($mapCities) ?>;
            cities.forEach(function(city) {
              L.marker([city.lat, city.lng])
                .addTo(map)
                .bindPopup('<b>' + city.name + '</b><br>CP: ' + city.cp);
            });
          });
        </script>
      </div>
    </div>
  </div>
</section>

<!-- Villes Section -->
<section class="section">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">📍 Zones d'intervention</span>
      <h2 class="section-title">Intervention dans les <span class="gradient-text">principales villes</span></h2>
    </div>

    <div class="cities-grid">
      <?php foreach ($topCities as $slug => $city): ?>
        <a href="/ville/<?= e($slug) ?>" class="city-card">
          <div class="city-card__visual">
            <span class="city-card__icon">🏘️</span>
            <span class="city-card__cp"><?= e($city['cp']) ?></span>
          </div>
          <div class="city-card__content">
            <h3 class="city-card__name"><?= e($city['name']) ?></h3>
            <p class="city-card__desc"><?= e($city['content_focus']) ?></p>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- FAQ Section -->
<section class="section section--alt">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">FAQ</span>
      <h2 class="section-title">Questions <span class="gradient-text">fréquentes</span></h2>
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

<!-- CTA Section -->
<section class="section">
  <div class="final-cta">
    <div class="final-cta__content">
      <h2>Besoin d'un devis pour votre chauffage ?</h2>
      <p class="lead">
        Contactez-nous pour un devis gratuit et personnalisé. 
        Intervention dans tout le département des Vosges (88).
      </p>
    </div>
    <div class="final-cta__actions">
      <a href="/contact" class="btn btn--primary btn--large">
        <span>📋</span> Demander un devis
      </a>
    </div>
  </div>
</section>

<!-- Phone CTA Section -->
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
  "@type": "LocalBusiness",
  "name": "Chauffage-Vosges",
  "description": "Expert en installation et dépannage de chauffage dans les Vosges (88). Chaudière gaz, pompe à chaleur, poêle à granulés. Devis gratuit.",
  "url": "https://chauffage-vosges.fr",
  "telephone": "<?= e($phone) ?>",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Épinal",
    "addressRegion": "Grand Est",
    "postalCode": "88000",
    "addressCountry": "FR"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 48.1735,
    "longitude": 6.4492
  },
  "areaServed": "Vosges (88)",
  "serviceType": ["Installation chauffage", "Dépannage chauffage", "Entretien chaudière"],
  "hasOfferCatalog": {
    "@type": "OfferCatalog",
    "name": "Services de chauffage",
    "itemListElement": [
      {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Chaudière Gaz"}},
      {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Pompe à Chaleur"}},
      {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Poêle à Granulés"}}
    ]
  }
}
</script>
