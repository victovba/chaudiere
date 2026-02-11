<?php
use App\Data;

$name = $commune['name'] ?? '';
$cp = $commune['cp'] ?? '';
$slug = $commune['slug'] ?? '';
$phone = $config['phone'] ?? '';
$heatingServices = $config['heating_services'] ?? [];
$mainCities = $config['main_cities'] ?? [];

// Données spécifiques ville
$cityData = $mainCities[$slug] ?? [];

$nearby = Data::nearby($commune, 8);
$top = Data::topByPopulation(6);
[$prev,$next] = Data::prevNext($slug);

$contactUrl = '/contact?ville=' . urlencode($name);

// Contenu unique par ville
$contents = [
  'epinal' => [
    'intro' => "Épinal, préfecture des Vosges, regroupe nombreuses maisons anciennes nécessitant rénovation énergétique. Notre expertise locale permet de proposer les meilleures solutions de chauffage adaptées au climat semi-continental.",
    'challenges' => ['Maisons anciennes mal isolées', 'Modernisation énergétique', 'Raccordement gaz disponible'],
    'solutions' => ['Chaudière condensation gaz', 'Pompe à chaleur air/eau', 'Plancher chauffant', 'Poêle granulés'],
    'aides' => "Épinal bénéficie des aides nationales MaPrimeRénov, CEE, TVA 5.5% ainsi que d'accompagnements locaux.",
    'temoignage' => "Remplacement chaudière fioul par condensation à Épinal. 2 500€ d'aides obtenues, facture baissée de 35% ! - Famille Martin"
  ],
  'saint-die-des-vosges' => [
    'intro' => "À 360m d'altitude dans une vallée encaissée, Saint-Dié connaît des hivers rigoureux. Solution de chauffage puissante et fiable essentielle.",
    'challenges' => ['Hivers -10°C à -15°C', 'Altitude élevée', 'Vallée encaissée'],
    'solutions' => ['PAC air/eau haute température', 'Chaudière gaz haute performance', 'Poêle granulés puissant'],
    'aides' => "Saint-Dié éligible à toutes les aides nationales. MaPrimeRénov avantageuse pour remplacements.",
    'temoignage' => "Pompe à chaleur installée fonctionne parfaitement à -8°C. Excellent travail ! - M. Dubois"
  ],
  'rambervillers' => [
    'intro' => "Commune rurale avec nombreuses chaudières fioul vieillissantes. Conversion vers solutions modernes = économies importantes.",
    'challenges' => ['Chaudières fioul à remplacer', 'Maisons individuelles isolées', 'Budgets limités'],
    'solutions' => ['Conversion fioul/gaz', 'Poêle granulés autonome', 'PAC avec appoint'],
    'aides' => "Conversion fioul/gaz aidée : MaPrimeRénov jusqu'à 2 500€ + CEE.",
    'temoignage' => "Conversion gaz réalisée. 400€ d'économies/an. Fini livraisons et odeur ! - Famille Leroy"
  ],
  'thaon-les-vosges' => [
    'intro' => "Zone industrielle et résidentielle mixte. Solutions économiques et performantes pour tous budgets.",
    'challenges' => ['Logements variés', 'Budgets maîtrisés', 'Besoins rapides'],
    'solutions' => ['Radiateurs électriques', 'Chaudière gaz économique', 'PAC air/air'],
    'aides' => "Foyers modestes : MaPrimeRénov Sérénité jusqu'à 90% sous conditions.",
    'temoignage' => "Radiateurs électriques neufs installés en 1 journée. Prime Énergie obtenue. - M. Petit"
  ],
  'bruyeres' => [
    'intro' => "À 500m d'altitude, hivers montagne exigeants. Solutions robustes pour froid vosgien.",
    'challenges' => ['Altitude 500m', 'Températures extrêmes', 'Hivers montagnards'],
    'solutions' => ['Poêle granulés puissant', 'Chaudière bois bûche', 'PAC montagne'],
    'aides' => "Aides renforcées énergies renouvelables : bois, granulés. Coup de pouce + MaPrimeRénov cumulables.",
    'temoignage' => "Poêle granulés chauffe parfaitement toute la maison. Énergie locale. - Famille Bernard"
  ],
  'golbey' => [
    'intro' => "Banlieue pavillonnaire moderne, constructions récentes bien isolées. Idéales solutions haute performance.",
    'challenges' => ['Pavillons récents bien isolés', 'Recherche confort optimal', 'Intérêt domotique'],
    'solutions' => ['Chaudière condensation gaz', 'Plancher chauffant', 'Thermostats connectés'],
    'aides' => "Constructions récentes : Prime Énergie pour solutions performantes. TVA 5.5%.",
    'temoignage' => "Plancher chauffant + PAC. Confort incomparable, pilotable smartphone. - M. Moreau"
  ]
];

$content = $contents[$slug] ?? $contents['epinal'];

// Services locaux
$localServices = array_slice($heatingServices, 0, 4);

// FAQ
$faqs = [
  ["Quel chauffage pour {$name} ?", "À {$name}, " . ($cityData['climate'] ?? 'climat vosgien') . ". Solutions adaptées selon isolation et budget."],
  ["Aides disponibles à {$name} ?", ($content['aides'] ?? 'MaPrimeRénov, CEE, TVA 5.5% disponibles.')],
  ["Délai intervention à {$name} ?", "24-48h sur {$name}. Urgences prioritaires en hiver."],
  ["Pompe à chaleur à {$name} ?", "PAC modernes fonctionnent jusqu'à -15°C, adaptées à {$name}."]
];
?>

<nav class="breadcrumbs">
  <a href="/">Accueil</a><span>›</span><a href="/communes">Zones</a><span>›</span><span><?= e($name) ?></span>
</nav>

<section class="city-hero">
  <div class="container">
    <div class="city-hero__badge">📍 <?= e($cp) ?> - <?= e($cityData['caracteristics'] ?? 'Vosges') ?></div>
    <h1 class="city-hero__title">Chauffage à <span class="gradient-text"><?= e($name) ?></span></h1>
    <p class="city-hero__desc"><?= $content['intro'] ?></p>
    <div class="city-hero__actions">
      <a href="<?= e($contactUrl) ?>" class="btn btn--primary btn--large">📋 Devis gratuit</a>
      <?php if ($phone): ?><a href="tel:<?= e(preg_replace('/\s+/', '', $phone)) ?>" class="btn btn--outline btn--large">📞 <?= e($phone) ?></a><?php endif; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="city-specifics">
      <div class="city-specifics__card">
        <h3>🏔️ Spécificités</h3>
        <ul><?php foreach ($content['challenges'] as $c): ?><li><?= e($c) ?></li><?php endforeach; ?></ul>
      </div>
      <div class="city-specifics__card city-specifics__card--highlight">
        <h3>✅ Solutions</h3>
        <ul><?php foreach ($content['solutions'] as $s): ?><li><?= e($s) ?></li><?php endforeach; ?></ul>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Recommandés</span>
      <h2 class="section-title">Solutions à <span class="gradient-text"><?= e($name) ?></span></h2>
    </div>
    <div class="services-grid">
      <?php foreach ($localServices as $s): ?>
        <a href="/chauffage/<?= e($s['slug']) ?>" class="service-card" style="--service-color: <?= $s['color'] ?>">
          <div class="service-card__icon" style="background: <?= $s['color'] ?>20; color: <?= $s['color'] ?>"><?= $s['icon'] ?></div>
          <h3 class="service-card__title"><?= e($s['title']) ?></h3>
          <p class="service-card__desc"><?= e($s['description']) ?></p>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section--aides">
  <div class="container">
    <div class="aides-box">
      <div class="aides-box__content">
        <h3>💰 Aides à <?= e($name) ?></h3>
        <p><?= $content['aides'] ?></p>
        <div class="aides-box__list">
          <span class="aide-tag">MaPrimeRénov</span><span class="aide-tag">CEE</span><span class="aide-tag">TVA 5.5%</span>
        </div>
      </div>
      <a href="<?= e($contactUrl) ?>" class="btn btn--primary">Calculer mes aides</a>
    </div>
  </div>
</section>

<?php if ($content['temoignage']): ?>
<section class="section">
  <div class="container">
    <div class="testimonial-card">
      <div class="testimonial-card__quote">"</div>
      <p><?= e($content['temoignage']) ?></p>
      <div class="testimonial-card__stars">⭐⭐⭐⭐⭐</div>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="section section--map">
  <div class="container">
    <div class="map-section">
      <div class="map-section__content">
        <h3>📍 Zone <?= e($name) ?></h3>
        <p>Intervention sur <?= e($name) ?> et environs.</p>
      </div>
      <div class="map-section__map">
        <div id="city-map" class="interactive-map"></div>
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('city-map').setView([<?= $latitude ?>, <?= $longitude ?>], 11);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
            L.marker([<?= $latitude ?>, <?= $longitude ?>]).addTo(map).bindPopup('<b><?= e($name) ?></b>');
          });
        </script>
      </div>
    </div>
  </div>
</section>

<section class="section section--faq">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">FAQ</span>
      <h2 class="section-title">Questions à <span class="gradient-text"><?= e($name) ?></span></h2>
    </div>
    <div class="faq-grid">
      <?php foreach ($faqs as $f): ?>
        <details class="faq-item">
          <summary><?= e($f[0]) ?></summary>
          <div class="faq-item__content"><p><?= e($f[1]) ?></p></div>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="final-cta">
    <div class="final-cta__content">
      <h2>Devis à <?= e($name) ?> ?</h2>
      <p class="lead">Étude gratuite, devis sous 24h.</p>
    </div>
    <div class="final-cta__actions">
      <a href="<?= e($contactUrl) ?>" class="btn btn--primary btn--large">📋 Demander un devis</a>
    </div>
  </div>
</section>

<!-- Section Téléphone Centrée -->
<section class="phone-cta-section">
  <div class="container">
    <div class="phone-cta-box">
      <span class="phone-cta-box__icon">📞</span>
      <h2 class="phone-cta-box__title">Préférez nous appeler ?</h2>
      <p class="phone-cta-box__subtitle">Pour les urgences ou demandes rapides à <?= e($name) ?></p>
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

<a class="sticky-cta" href="<?= e($contactUrl) ?>"><span>📋</span> Devis <?= e($name) ?></a>
