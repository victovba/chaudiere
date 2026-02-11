<?php
$phone = $config['phone'] ?? '';
$heatingServices = $config['heating_services'] ?? [];
$mainCities = $config['main_cities'] ?? [];

// Stats pour hero
$stats = [
  ['number' => '15+', 'label' => 'Années expertise', 'icon' => '🏆'],
  ['number' => '8', 'label' => 'Types de chauffage', 'icon' => '🔥'],
  ['number' => '24h', 'label' => 'Délai moyen', 'icon' => '⚡'],
  ['number' => '100%', 'label' => 'Devis gratuits', 'icon' => '📋'],
];

// Villes pour la carte (coordonnées GPS approximatives)
$mapCities = [
  ['name' => 'Épinal', 'lat' => 48.1735, 'lng' => 6.4492, 'cp' => '88000'],
  ['name' => 'Saint-Dié', 'lat' => 48.2855, 'lng' => 6.9479, 'cp' => '88100'],
  ['name' => 'Rambervillers', 'lat' => 48.3456, 'lng' => 6.6346, 'cp' => '88700'],
  ['name' => 'Thaon-les-Vosges', 'lat' => 48.2514, 'lng' => 6.4197, 'cp' => '88150'],
  ['name' => 'Bruyères', 'lat' => 48.2083, 'lng' => 6.7194, 'cp' => '88600'],
  ['name' => 'Golbey', 'lat' => 48.1944, 'lng' => 6.4306, 'cp' => '88190'],
];
?>

<!-- Hero Section avec design moderne -->
<section class="hero-home">
  <div class="hero-home__bg"></div>
  <div class="container">
    <div class="hero-home__grid">
      <div class="hero-home__content">
        <div class="hero-home__badge">
          <span class="hero-home__badge-icon">🏔️</span>
          <span>Experts chauffage dans les Vosges (88)</span>
        </div>
        
        <h1 class="hero-home__title">
          Installation & dépannage<br>
          <span class="gradient-text">tous types de chauffage</span><br>
          <span class="text-white">dans les Vosges</span>
        </h1>
        
        <p class="hero-home__lead">
          Solutions chauffage adaptées au climat vosgien. Chaudière gaz, électrique, 
          à condensation, pompe à chaleur, poêle à granulés. Devis gratuit sous 24h.
        </p>
        
        <div class="hero-home__actions">
          <a href="/contact" class="btn btn--primary btn--large">
            <span>📋</span> Devis gratuit
          </a>
          <?php if ($phone): ?>
          <a href="tel:<?= e(preg_replace('/\s+/', '', $phone)) ?>" class="btn btn--outline btn--large">
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
          <div class="hero-visual__mountains">🏔️</div>
          <div class="hero-visual__houses">
            <span class="house">🏠</span>
            <span class="house house--2">🏡</span>
            <span class="house house--3">🏘️</span>
          </div>
          <div class="hero-visual__heating">🔥</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Services Grid -->
<section class="section section--services">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Nos solutions</span>
      <h2 class="section-title">Tous les types de <span class="gradient-text">chauffage</span></h2>
      <p class="section-desc">Solutions adaptées à votre maison et votre budget dans les Vosges</p>
    </div>

    <div class="services-grid">
      <?php foreach ($heatingServices as $service): ?>
        <a href="/chauffage/<?= e($service['slug']) ?>" class="service-card" style="--service-color: <?= $service['color'] ?>">
          <div class="service-card__icon" style="background: <?= $service['color'] ?>20; color: <?= $service['color'] ?>">
            <?= $service['icon'] ?>
          </div>
          <h3 class="service-card__title"><?= e($service['title']) ?></h3>
          <p class="service-card__desc"><?= e($service['description']) ?></p>
          <span class="service-card__link">En savoir plus →</span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Map Section Interactive -->
<section class="section section--map">
  <div class="container">
    <div class="map-section">
      <div class="map-section__content">
        <span class="section-tag">📍 Zones d'intervention</span>
        <h2 class="section-title">Nous intervenons dans <span class="gradient-text">tout le département</span></h2>
        <p class="section-desc">
          Basés au cœur des Vosges, nous couvrons l'ensemble du département (88) : 
          Épinal, Saint-Dié-des-Vosges, Rambervillers, Thaon-les-Vosges et toutes les communes.
        </p>
        
        <div class="map-cities">
          <?php foreach ($mainCities as $slug => $city): ?>
            <a href="/ville/<?= e($slug) ?>" class="map-city">
              <span class="map-city__name"><?= e($city['name']) ?></span>
              <span class="map-city__cp"><?= e($city['cp']) ?></span>
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
                .bindPopup('<b>' + city.name + '</b><br>' + city.cp + '<br><a href="/ville/' + city.name.toLowerCase().replace(/ /g, '-') + '">Voir la page</a>');
            });
          });
        </script>
      </div>
    </div>
  </div>
</section>

<!-- Pourquoi nous choisir -->
<section class="section section--why">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Pourquoi nous ?</span>
      <h2 class="section-title">L'expertise chauffage <span class="gradient-text">dans les Vosges</span></h2>
    </div>

    <div class="why-grid">
      <div class="why-card">
        <div class="why-card__icon">🏔️</div>
        <h3 class="why-card__title">Spécialistes du climat vosgien</h3>
        <p class="why-card__desc">
          Nous connaissons les spécificités des Vosges : hivers froids, maisons anciennes, 
          altitude. Nous proposons des solutions adaptées à chaque situation.
        </p>
      </div>

      <div class="why-card">
        <div class="why-card__icon">🏆</div>
        <h3 class="why-card__title">Certifiés RGE QualiPAC</h3>
        <p class="why-card__desc">
          Profitez des aides de l'État : MaPrimeRénov', CEE, TVA réduite. 
          Notre certification RGE vous garantit l'accès aux subventions.
        </p>
      </div>

      <div class="why-card">
        <div class="why-card__icon">⚡</div>
        <h3 class="why-card__title">Intervention rapide</h3>
        <p class="why-card__desc">
          Délai moyen de 24h pour les dépannages. Service d'urgence disponible 
          pour les pannes de chauffage en plein hiver.
        </p>
      </div>

      <div class="why-card">
        <div class="why-card__icon">📋</div>
        <h3 class="why-card__title">Devis transparent</h3>
        <p class="why-card__desc">
          Devis gratuit et détaillé sous 24h. Pas de surprise, pas de frais cachés. 
          Prix compétitifs sur toutes les solutions chauffage.
        </p>
      </div>

      <div class="why-card">
        <div class="why-card__icon">🔧</div>
        <h3 class="why-card__title">Toutes marques</h3>
        <p class="why-card__desc">
          Interventions sur toutes les marques : Saunier Duval, Frisquet, 
          Chaffoteaux, Atlantic, Viessmann, et bien d'autres.
        </p>
      </div>

      <div class="why-card">
        <div class="why-card__icon">🛡️</div>
        <h3 class="why-card__title">Garantie décennale</h3>
        <p class="why-card__desc">
          Toutes nos installations sont couvertes par une assurance décennale. 
          Garantie pièces et main d'œuvre sur le long terme.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Process -->
<section class="section section--process">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Notre process</span>
      <h2 class="section-title">Comment ça <span class="gradient-text">marche ?</span></h2>
    </div>

    <div class="process-steps">
      <div class="process-step">
        <div class="process-step__number">1</div>
        <div class="process-step__content">
          <div class="process-step__icon">📞</div>
          <h3 class="process-step__title">Votre demande</h3>
          <p class="process-step__desc">Contactez-nous par téléphone ou formulaire. Décrivez votre besoin.</p>
        </div>
      </div>

      <div class="process-step">
        <div class="process-step__number">2</div>
        <div class="process-step__content">
          <div class="process-step__icon">📋</div>
          <h3 class="process-step__title">Devis gratuit</h3>
          <p class="process-step__desc">Devis détaillé sous 24h avec plusieurs options selon votre budget.</p>
        </div>
      </div>

      <div class="process-step">
        <div class="process-step__number">3</div>
        <div class="process-step__content">
          <div class="process-step__icon">📅</div>
          <h3 class="process-step__title">Intervention</h3>
          <p class="process-step__desc">Installation ou dépannage à la date convenue. Travail soigné et propre.</p>
        </div>
      </div>

      <div class="process-step">
        <div class="process-step__number">4</div>
        <div class="process-step__content">
          <div class="process-step__icon">✅</div>
          <h3 class="process-step__title">Suivi garanti</h3>
          <p class="process-step__desc">Garantie décennale et SAV. Nous restons disponibles après l'installation.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Villes Populaires -->
<section class="section section--cities">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">📍 Zones</span>
      <h2 class="section-title">Intervention dans les <span class="gradient-text">principales villes</span></h2>
    </div>

    <div class="cities-grid">
      <?php foreach ($mainCities as $slug => $city): ?>
        <a href="/ville/<?= e($slug) ?>" class="city-card">
          <div class="city-card__visual">
            <span class="city-card__icon">🏘️</span>
            <span class="city-card__cp"><?= e($city['cp']) ?></span>
          </div>
          <div class="city-card__content">
            <h3 class="city-card__name"><?= e($city['name']) ?></h3>
            <p class="city-card__desc"><?= e($city['content_focus']) ?></p>
            <span class="city-card__link">Voir les services →</span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="section section--faq">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">FAQ</span>
      <h2 class="section-title">Questions <span class="gradient-text">fréquentes</span></h2>
    </div>

    <div class="faq-grid">
      <details class="faq-item">
        <summary>Quelle chaudière choisir pour les Vosges ?</summary>
        <div class="faq-item__content">
          <p>Dans les Vosges, avec des hivers pouvant atteindre -10°C à -15°C selon l'altitude, nous recommandons :</p>
          <ul>
            <li><strong>Chaudière à condensation gaz</strong> : idéale pour le remplacement, économies 25-30%</li>
            <li><strong>Pompe à chaleur air/eau</strong> : solution écologique, très efficace même par -5°C avec les modèles récents</li>
            <li><strong>Poêle à granulés</strong> : complément parfait pour les maisons mal isolées</li>
          </ul>
          <p>Nous étudions votre situation (isolation, surface, budget) pour vous proposer la meilleure solution.</p>
        </div>
      </details>

      <details class="faq-item">
        <summary>Quelles aides pour changer ma chaudière dans les Vosges ?</summary>
        <div class="faq-item__content">
          <p>En tant qu'installateur RGE QualiPAC, nous vous accompagnons pour :</p>
          <ul>
            <li><strong>MaPrimeRénov'</strong> : jusqu'à 2 500€ pour une chaudière condensation</li>
            <li><strong>CEE (Prime Énergie)</strong> : selon le gain énergétique réalisé</li>
            <li><strong>TVA réduite à 5.5%</strong> sur les travaux de rénovation énergétique</li>
            <li><strong>Aide locale départementale</strong> des Vosges pour certains projets</li>
          </ul>
          <p>Nous calculons vos aides et les intégrons directement dans votre devis.</p>
        </div>
      </details>

      <details class="faq-item">
        <summary>Quel délai pour installer une chaudière ?</summary>
        <div class="faq-item__content">
          <p>Le délai d'installation dépend du type de travaux :</p>
          <ul>
            <li><strong>Remplacement simple</strong> (chaudière murale gaz) : 1 journée</li>
            <li><strong>Changement de technologie</strong> (fioul vers gaz) : 1 à 2 jours</li>
            <li><strong>Installation pompe à chaleur</strong> : 2 à 3 jours</li>
            <li><strong>Plancher chauffant complet</strong> : 3 à 5 jours</li>
          </ul>
          <p>Nous planifions l'intervention selon vos disponibilités, avec un dépannage temporaire si nécessaire.</p>
        </div>
      </details>

      <details class="faq-item">
        <summary>Intervenez-vous en urgence en plein hiver ?</summary>
        <div class="faq-item__content">
          <p>Oui ! Nous proposons un service de dépannage urgent 7j/7 en saison de chauffe (octobre à avril) :</p>
          <ul>
            <li>Panncs de chaudière en plein hiver</li>
            <li>Fuites d'eau sur installation chauffage</li>
            <li>Plus de chauffage ni d'eau chaude</li>
            <li>Codes erreur critiques</li>
          </ul>
          <p>Appelez-nous au <?= e($phone ?: '03 29 XX XX XX') ?>, nous intervenons dans les 24h maximum.</p>
        </div>
      </details>

      <details class="faq-item">
        <summary>Quel entretien pour ma chaudière dans les Vosges ?</summary>
        <div class="faq-item__content">
          <p>L'entretien annuel est obligatoire pour :</p>
          <ul>
            <li><strong>Chaudières gaz</strong> : depuis 2009, obligation légale</li>
            <li><strong>Chaudières fioul</strong> : depuis 2010, obligation légale</li>
            <li><strong>Pompes à chaleur</strong> : recommandé pour maintenir l'efficacité</li>
          </ul>
          <p>Nos forfaits entretien incluent : nettoyage, réglages, contrôles de sécurité et attestation. À partir de 120€ TTC.</p>
        </div>
      </details>

      <details class="faq-item">
        <summary>Puis-je convertir mon chauffage fioul en gaz ?</summary>
        <div class="faq-item__content">
          <p>Oui, et c'est souvent très pertinent ! La conversion fioul vers gaz naturel permet :</p>
          <ul>
            <li>Économies de 30 à 40% sur la facture</li>
            <li>Fin des livraisons de fioul</li>
            <li>Plus de maintenance de cuve</li>
            <li>Réduction des émissions polluantes</li>
          </ul>
          <p>Nous étudions la faisabilité (raccordement au réseau gaz) et vous accompagnons dans les démarches.</p>
        </div>
      </details>
    </div>
  </div>
</section>

<!-- CTA Final Centré -->
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
