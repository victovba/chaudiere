<?php
use App\DataEPCI;

$phone = $config['phone'] ?? '';
$heatingServices = $config['heating_services'] ?? [];
$silo = $silo ?? [];
$communes = $silo['communes'] ?? [];
$mainCity = $silo['main_city'] ?? '';
?>

<nav class="breadcrumbs">
  <a href="/">Accueil</a>
  <span>›</span>
  <a href="/zones">Zones d'intervention</a>
  <span>›</span>
  <span><?= e($silo['silo_name'] ?? '') ?></span>
</nav>

<!-- Hero Silo -->
<section class="city-hero">
  <div class="container">
    <div class="city-hero__badge">
      📍 <?= e($silo['silo_name'] ?? '') ?>
    </div>
    <h1 class="city-hero__title">
      Chauffage <?= e($mainCity) ?> et alentours
    </h1>
    <p class="city-hero__desc">
      <?= e($silo['description'] ?? '') ?> 
      Nous intervenons sur <?= count($communes) ?> communes de ce territoire avec nos solutions 
      de chauffage adaptées au climat local.
    </p>
    <div class="city-hero__actions">
      <a href="/contact" class="btn btn--primary btn--large">
        📋 Devis gratuit
      </a>
      <?php if ($phone): ?>
      <a href="tel:<?= e(preg_replace('/\s+/', '', $phone)) ?>" class="btn btn--outline btn--large">
        📞 <?= e($phone) ?>
      </a>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <!-- Stats -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
      <div style="background: var(--bg-white); border: 1px solid var(--border-color); border-radius: var(--radius); padding: 1.5rem; text-align: center;">
        <div style="font-size: 2.5rem; font-weight: 700; color: var(--primary-green);"><?= count($communes) ?></div>
        <div style="color: var(--text-secondary);">Communes</div>
      </div>
      <div style="background: var(--bg-white); border: 1px solid var(--border-color); border-radius: var(--radius); padding: 1.5rem; text-align: center;">
        <div style="font-size: 2.5rem; font-weight: 700; color: var(--primary-green);"><?= number_format($silo['population'] ?? 0, 0, ',', ' ') ?></div>
        <div style="color: var(--text-secondary);">Habitants</div>
      </div>
      <div style="background: var(--bg-white); border: 1px solid var(--border-color); border-radius: var(--radius); padding: 1.5rem; text-align: center;">
        <div style="font-size: 2.5rem; font-weight: 700; color: var(--primary-green);">24h</div>
        <div style="color: var(--text-secondary);">Devis rapide</div>
      </div>
    </div>

    <!-- Services locaux -->
    <div class="section-header section-header--center" style="margin-bottom: 2rem;">
      <span class="section-tag">Nos solutions</span>
      <h2 class="section-title">Services de chauffage à <?= e($mainCity) ?></h2>
    </div>

    <div class="services-grid" style="margin-bottom: 4rem;">
      <?php foreach (array_slice($heatingServices, 0, 4) as $service): ?>
        <a href="/chauffage/<?= e($service['slug']) ?>" class="service-card">
          <div class="service-card__icon"><?= $service['icon'] ?></div>
          <h3 class="service-card__title"><?= e($service['title']) ?></h3>
          <p class="service-card__desc"><?= e($service['description']) ?></p>
          <span class="service-card__link">En savoir plus →</span>
        </a>
      <?php endforeach; ?>
    </div>

    <!-- Liste des communes -->
    <div class="section-header" style="margin-bottom: 2rem;">
      <span class="section-tag">📍 Communes desservies</span>
      <h2 class="section-title">Toutes les communes de <?= e($silo['silo_name']) ?></h2>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1rem; margin-bottom: 3rem;">
      <?php foreach ($communes as $commune): ?>
        <a href="/ville/<?= e($commune['slug']) ?>" 
           style="display: flex; align-items: center; gap: 1rem; padding: 1rem; 
                  background: var(--bg-white); border: 1px solid var(--border-color); 
                  border-radius: var(--radius-sm); text-decoration: none; 
                  transition: all 0.2s;"
           onmouseover="this.style.borderColor='var(--primary-green)'; this.style.transform='translateY(-2px)';"
           onmouseout="this.style.borderColor='var(--border-color)'; this.style.transform='translateY(0)';">
          <span style="font-size: 1.25rem;">🏘️</span>
          <div style="flex: 1;">
            <div style="font-weight: 500; color: var(--text-primary);"><?= e($commune['name']) ?></div>
            <div style="font-size: 0.8125rem; color: var(--text-secondary);"><?= e($commune['postal_code']) ?></div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>

    <!-- Aides -->
    <div style="background: var(--accent-soft); border-radius: var(--radius); padding: 2rem; margin-bottom: 3rem;">
      <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem; color: var(--text-primary);">
        💰 Aides disponibles dans cette zone
      </h3>
      <p style="color: var(--text-secondary); margin-bottom: 1rem;">
        Toutes les communes de <?= e($silo['silo_name']) ?> sont éligibles aux aides de l'État :
      </p>
      <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
        <span style="padding: 0.5rem 1rem; background: var(--bg-white); border-radius: var(--radius-full); font-size: 0.875rem; font-weight: 500;">MaPrimeRénov' jusqu'à 5 000€</span>
        <span style="padding: 0.5rem 1rem; background: var(--bg-white); border-radius: var(--radius-full); font-size: 0.875rem; font-weight: 500;">Prime Énergie CEE</span>
        <span style="padding: 0.5rem 1rem; background: var(--bg-white); border-radius: var(--radius-full); font-size: 0.875rem; font-weight: 500;">TVA 5.5%</span>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section" style="background: var(--bg-alt);">
  <div class="container">
    <div class="final-cta">
      <div class="final-cta__content">
        <h2>Besoin d'un chauffagiste à <?= e($mainCity) ?> ?</h2>
        <p class="lead">Devis gratuit sous 24h. Installation certifiée RGE avec aides MaPrimeRénov'.</p>
      </div>
      <div class="final-cta__actions">
        <a href="/contact" class="btn btn--primary btn--large">📋 Demander un devis</a>
      </div>
    </div>
  </div>
</section>

<section class="phone-cta-section">
  <div class="container">
    <div class="phone-cta-box">
      <span class="phone-cta-box__icon">📞</span>
      <h2 class="phone-cta-box__title">Appelez-nous</h2>
      <p class="phone-cta-box__subtitle">Intervention sur <?= e($silo['silo_name']) ?></p>
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
  "@type": "ServiceArea",
  "name": "<?= e($silo['silo_name']) ?>",
  "description": "<?= e($silo['description'] ?? '') ?>",
  "provider": {
    "@type": "LocalBusiness",
    "name": "Chauffage-Vosges",
    "address": {
      "@type": "PostalAddress",
      "addressRegion": "Grand Est",
      "addressLocality": "<?= e($mainCity) ?>",
      "postalCode": "<?= e($communes[0]['postal_code'] ?? '88000') ?>"
    }
  },
  "areaServed": {
    "@type": "AdministrativeArea",
    "name": "<?= e($silo['silo_name']) ?>"
  }
}
</script>
