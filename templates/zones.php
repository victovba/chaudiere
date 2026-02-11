<?php
use App\DataEPCI;

$phone = $config['phone'] ?? '';
$heatingServices = $config['heating_services'] ?? [];
$silos = DataEPCI::loadSilos();
$totalCommunes = DataEPCI::getAllCommunesCount();
?>

<nav class="breadcrumbs">
  <a href="/">Accueil</a>
  <span>›</span>
  <span>Zones d'intervention</span>
</nav>

<section class="section">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">📍 Zones d'intervention</span>
      <h1 class="section-title">
        Intervention dans les <span class="gradient-text">Vosges (88)</span>
      </h1>
      <p class="section-desc">
        Nous couvrons tout le département des Vosges à travers <?= count($silos) ?> territoires 
        regroupant <?= $totalCommunes ?> communes. Découvrez les zones où nous intervenons.
      </p>
    </div>

    <!-- Carte des silos -->
    <div class="silos-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin-bottom: 4rem;">
      <?php foreach ($silos as $silo): ?>
        <a href="/zone/<?= e($silo['slug']) ?>" class="silo-card" 
           style="display: block; background: var(--bg-white); border: 1px solid var(--border-color); 
                  border-radius: var(--radius); padding: 2rem; text-decoration: none; 
                  transition: all 0.3s ease; box-shadow: var(--shadow);">
          <div style="display: flex; align-items: flex-start; gap: 1rem; margin-bottom: 1rem;">
            <div style="width: 56px; height: 56px; background: var(--accent-soft); border-radius: var(--radius); 
                        display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
              🏘️
            </div>
            <div style="flex: 1;">
              <h3 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 0.25rem; color: var(--text-primary);">
                <?= e($silo['silo_name']) ?>
              </h3>
              <p style="font-size: 0.875rem; color: var(--text-secondary); margin: 0;">
                <?= count($silo['communes'] ?? []) ?> communes • <?= number_format($silo['population'] ?? 0, 0, ',', ' ') ?> hab.
              </p>
            </div>
          </div>
          <p style="font-size: 0.9375rem; color: var(--text-secondary); line-height: 1.6; margin-bottom: 1rem;">
            <?= e($silo['description'] ?? '') ?>
          </p>
          <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
            <?php foreach (array_slice($silo['communes'] ?? [], 0, 4) as $commune): ?>
              <span style="padding: 0.25rem 0.75rem; background: var(--bg-alt); border-radius: var(--radius-full); 
                          font-size: 0.8125rem; color: var(--text-secondary);">
                <?= e($commune['name']) ?>
              </span>
            <?php endforeach; ?>
            <?php if (count($silo['communes'] ?? []) > 4): ?>
              <span style="padding: 0.25rem 0.75rem; font-size: 0.8125rem; color: var(--primary-green);">
                +<?= count($silo['communes']) - 4 ?> autres
              </span>
            <?php endif; ?>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<style>
.silo-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-lg) !important;
  border-color: var(--primary-light) !important;
}
</style>

<!-- CTA -->
<section class="section" style="background: var(--bg-alt);">
  <div class="container">
    <div class="final-cta">
      <div class="final-cta__content">
        <h2>Vous ne trouvez pas votre zone ?</h2>
        <p class="lead">Nous intervenons sur l'ensemble du département des Vosges. Contactez-nous !</p>
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
      <h2 class="phone-cta-box__title">Une question sur votre zone ?</h2>
      <p class="phone-cta-box__subtitle">Nos experts vous conseillent</p>
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
