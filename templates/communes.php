<?php
use App\Data;

$heatingServices = $config['heating_services'] ?? [];
$phone = $config['phone'] ?? '';

// Charger toutes les communes
$allCommunes = Data::loadCommunes();
$totalCommunes = count($allCommunes);

// Top 12 par population pour la section featured
$topCities = Data::topByPopulation(12);

// Index alphabétique
$alphaIndex = Data::alphaIndex();
?>

<nav class="breadcrumbs">
  <a href="/">Accueil</a>
  <span>›</span>
  <span>Toutes les communes</span>
</nav>

<section class="section">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">📍 Intervention</span>
      <h1 class="section-title">
        <?= $totalCommunes ?> communes des <span class="gradient-text">Vosges (88)</span>
      </h1>
      <p class="section-desc">
        Nous intervenons sur l'ensemble du département. Trouvez votre commune ci-dessous 
        pour accéder à une page dédiée avec nos services de chauffage.
      </p>
    </div>

    <!-- Navigation A-Z -->
    <div class="az-nav" style="margin-bottom: 3rem;">
      <?php foreach (range('A', 'Z') as $letter): ?>
        <?php $count = isset($alphaIndex[$letter]) ? count($alphaIndex[$letter]) : 0; ?>
        <?php if ($count > 0): ?>
          <a href="#letter-<?= strtolower($letter) ?>" class="az-nav__link">
            <?= $letter ?>
            <small style="font-size: 0.7rem; display: block;">(<?= $count ?>)</small>
          </a>
        <?php else: ?>
          <span class="az-nav__link" style="opacity: 0.3; cursor: not-allowed;"><?= $letter ?></span>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>

    <!-- Top Villes -->
    <div class="section-header">
      <span class="section-tag">🏆</span>
      <h2 class="section-title">Principales villes</h2>
    </div>

    <div class="cities-grid" style="margin-bottom: 4rem;">
      <?php foreach ($topCities as $city): ?>
        <a href="/ville/<?= e($city['slug']) ?>" class="city-card">
          <div class="city-card__visual">
            <span class="city-card__icon">🏘️</span>
            <span class="city-card__cp"><?= e($city['cp']) ?></span>
          </div>
          <div class="city-card__content">
            <h3 class="city-card__name"><?= e($city['name']) ?></h3>
            <p class="city-card__desc">
              <?= number_format($city['population'], 0, ',', ' ') ?> habitants
            </p>
          </div>
        </a>
      <?php endforeach; ?>
    </div>

    <!-- Toutes les communes par lettre -->
    <div class="section-header">
      <span class="section-tag">📋</span>
      <h2 class="section-title">Index complet A-Z</h2>
    </div>

    <?php foreach ($alphaIndex as $letter => $communes): ?>
      <?php if ($letter === '#') continue; ?>
      <div id="letter-<?= strtolower($letter) ?>" style="margin-bottom: 3rem;">
        <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: var(--primary-green); 
                   border-bottom: 2px solid var(--accent-soft); padding-bottom: 0.5rem;">
          <?= $letter ?> 
          <small style="font-size: 0.875rem; font-weight: 500; color: var(--text-secondary);">
            (<?= count($communes) ?> commune<?= count($communes) > 1 ? 's' : '' ?>)
          </small>
        </h3>
        
        <div class="communes-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 0.75rem;">
          <?php foreach ($communes as $commune): ?>
            <a href="/ville/<?= e($commune['slug']) ?>" class="commune-card" 
               style="display: flex; align-items: center; gap: 0.75rem; padding: 0.875rem; 
                      background: var(--bg-white); border: 1px solid var(--border-color); 
                      border-radius: var(--radius-sm); text-decoration: none; transition: all 0.2s;">
              <span style="font-size: 1.25rem;">🏘️</span>
              <div style="flex: 1; min-width: 0;">
                <div style="font-weight: 500; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                  <?= e($commune['name']) ?>
                </div>
                <div style="font-size: 0.75rem; color: var(--text-secondary);">
                  <?= e($commune['cp']) ?>
                </div>
              </div>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- CTA -->
<section class="section" style="background: var(--bg-alt);">
  <div class="container">
    <div class="final-cta">
      <div class="final-cta__content">
        <h2>Vous ne trouvez pas votre commune ?</h2>
        <p class="lead">Nous intervenons sur tout le département des Vosges (88). Contactez-nous !</p>
      </div>
      <div class="final-cta__actions">
        <a href="/contact" class="btn btn--primary btn--large">📋 Nous contacter</a>
      </div>
    </div>
  </div>
</section>

<section class="phone-cta-section">
  <div class="container">
    <div class="phone-cta-box">
      <span class="phone-cta-box__icon">📞</span>
      <h2 class="phone-cta-box__title">Une question ?</h2>
      <p class="phone-cta-box__subtitle">Nos experts vous répondent</p>
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
