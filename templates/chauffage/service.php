<?php
use App\Data;

$phone = $config['phone'] ?? '';
$mainCities = $config['main_cities'] ?? [];
$topCities = Data::topByPopulation(6) ?? [];
?>

<nav class="breadcrumbs">
  <a href="/">Accueil</a><span>›</span><a href="/chauffage">Solutions</a><span>›</span><span><?= e($service['title']) ?></span>
</nav>

<!-- Hero Service -->
<section class="service-hero">
  <div class="service-hero__bg" style="background: linear-gradient(135deg, <?= $service['color'] ?>20 0%, var(--color-bg) 100%);"></div>
  <div class="container">
    <div class="service-hero__grid">
      <div class="service-hero__content">
        <div class="service-hero__badge" style="background: <?= $service['color'] ?>30; color: <?= $service['color'] ?>;">
          <?= $service['icon'] ?> <?= e($service['title']) ?> dans les Vosges
        </div>
        <h1 class="service-hero__title">
          <?= e($service['meta_title'] ?? $service['title']) ?>
        </h1>
        <p class="service-hero__desc">
          <?= e($service['description']) ?>
        </p>
        <div class="service-hero__actions">
          <a href="/contact?service=<?= urlencode($service['title']) ?>" class="btn btn--primary btn--large">
            📋 Devis gratuit
          </a>
          <?php if ($phone): ?>
          <a href="tel:<?= e(preg_replace('/\s+/', '', $phone)) ?>" class="btn btn--outline btn--large">
            📞 <?= e($phone) ?>
          </a>
          <?php endif; ?>
        </div>
      </div>
      <div class="service-hero__visual">
        <div class="service-visual-card" style="border-color: <?= $service['color'] ?>;">
          <span class="service-visual-card__icon"><?= $service['icon'] ?></span>
          <h3><?= e($service['title']) ?></h3>
          <p>Expertise locale dans les Vosges</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Features -->
<section class="section">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Nos services</span>
      <h2 class="section-title"><?= e($service['title']) ?> : <span class="gradient-text">nos prestations</span></h2>
    </div>

    <div class="features-list">
      <?php foreach ($service['features'] ?? [] as $index => $feature): ?>
        <div class="feature-row">
          <div class="feature-row__number" style="background: <?= $service['color'] ?>;"><?= $index + 1 ?></div>
          <div class="feature-row__content">
            <h3><?= e($feature) ?></h3>
            <p><?= e($feature) ?> - Service professionnel dans les Vosges.</p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Benefits -->
<section class="section section--benefits">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Avantages</span>
      <h2 class="section-title">Pourquoi choisir le <span class="gradient-text"><?= strtolower($service['title']) ?></span> ?</h2>
    </div>

    <div class="benefits-grid">
      <?php foreach ($service['benefits'] ?? [] as $benefit): ?>
        <div class="benefit-card" style="--benefit-color: <?= $service['color'] ?>;">
          <span class="benefit-card__icon">✓</span>
          <h3><?= e($benefit) ?></h3>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Aides -->
<section class="section section--aides">
  <div class="container">
    <div class="aides-box">
      <div class="aides-box__content">
        <h3>💰 Aides & Subventions</h3>
        <p>Le <?= strtolower($service['title']) ?> est éligible aux aides de l'État pour la rénovation énergétique :</p>
        <div class="aides-box__list">
          <span class="aide-tag">MaPrimeRénov</span>
          <span class="aide-tag">Prime Énergie CEE</span>
          <span class="aide-tag">TVA 5.5%</span>
          <span class="aide-tag">Éco-PTZ</span>
        </div>
        <p style="margin-top: 1rem; font-size: 0.9375rem; color: var(--color-text-muted);">
          Nos experts calculent vos droits aux aides et les déduisent directement de votre devis.
        </p>
      </div>
      <a href="/contact?service=<?= urlencode($service['title']) ?>" class="btn btn--primary">Calculer mes aides</a>
    </div>
  </div>
</section>

<!-- Villes -->
<section class="section">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">Zones</span>
      <h2 class="section-title">Intervention dans les <span class="gradient-text">Vosges</span></h2>
    </div>
    <div class="cities-grid">
      <?php foreach ($mainCities as $slug => $city): ?>
        <a href="/ville/<?= e($slug) ?>" class="city-card">
          <div class="city-card__visual" style="background: <?= $service['color'] ?>30;">
            <span class="city-card__icon">🏘️</span>
          </div>
          <div class="city-card__content">
            <h3><?= e($city['name']) ?></h3>
            <p><?= e($city['cp']) ?></p>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
    <div style="text-align: center; margin-top: 2rem;">
      <a href="/communes" class="btn btn--outline">Voir toutes les communes</a>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="section section--faq">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-tag">FAQ</span>
      <h2 class="section-title">Questions sur le <span class="gradient-text"><?= strtolower($service['title']) ?></span></h2>
    </div>
    <div class="faq-grid">
      <details class="faq-item">
        <summary>Quel est le prix d'un <?= strtolower($service['title']) ?> dans les Vosges ?</summary>
        <div class="faq-item__content">
          <p>Le tarif varie selon la puissance, la marque et les options choisies. Nous vous fournissons un devis détaillé et gratuit après visite technique ou sur description de votre projet.</p>
        </div>
      </details>
      <details class="faq-item">
        <summary>Quelles aides pour un <?= strtolower($service['title']) ?> ?</summary>
        <div class="faq-item__content">
          <p>MaPrimeRénov', Prime Énergie CEE, TVA réduite à 5.5%. Le montant des aides peut couvrir 30 à 70% du coût selon vos revenus.</p>
        </div>
      </details>
      <details class="faq-item">
        <summary>Quel délai pour l'installation ?</summary>
        <div class="faq-item__content">
          <p>Comptez 1 à 3 jours pour l'installation selon la complexité du projet. Nous planifions selon vos disponibilités.</p>
        </div>
      </details>
      <details class="faq-item">
        <summary>Proposez-vous l'entretien du <?= strtolower($service['title']) ?> ?</summary>
        <div class="faq-item__content">
          <p>Oui ! Nous proposons des contrats d'entretien annuels pour garantir le bon fonctionnement et la longévité de votre équipement.</p>
        </div>
      </details>
    </div>
  </div>
</section>

<!-- CTA Centré -->
<section class="section">
  <div class="final-cta">
    <div class="final-cta__content">
      <h2>Devis <?= e($service['title']) ?> gratuit</h2>
      <p class="lead">Contactez-nous pour une étude personnalisée de votre projet dans les Vosges.</p>
    </div>
    <div class="final-cta__actions">
      <a href="/contact?service=<?= urlencode($service['title']) ?>" class="btn btn--primary btn--large">📋 Demander un devis</a>
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

<!-- Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "<?= e($service['title']) ?> - Chauffage-Vosges",
  "description": "<?= e($service['description']) ?>",
  "areaServed": {
    "@type": "AdministrativeArea",
    "name": "Vosges (88)"
  },
  "provider": {
    "@type": "LocalBusiness",
    "name": "Chauffage-Vosges",
    "areaServed": "Vosges"
  }
}
</script>
