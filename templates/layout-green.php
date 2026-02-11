<?php
use App\Csrf;

$tpl = $templateFile;
function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
$csrf = Csrf::token();
$sent = isset($_GET['sent']) && $_GET['sent'] == '1';

$brand = $config['brand'] ?? 'Chauffage-Vosges';
$phone = $config['phone'] ?? '';
$email = $config['lead_to_email'] ?? '';
$address = $config['address'] ?? [];
$baseUrl = rtrim($config['base_url'] ?? '', '/');;
$heatingServices = $config['heating_services'] ?? [];

// Navigation SEO optimisée
$navItems = [
  ['label' => 'Chaudière Gaz', 'url' => '/chauffage/chaudiere-gaz', 'icon' => '🔥', 'desc' => 'Installation & réparation'],
  ['label' => 'Pompe à Chaleur', 'url' => '/chauffage/pompe-a-chaleur', 'icon' => '🌱', 'desc' => 'PAC air/eau et air/air'],
  ['label' => 'Chaudière Condensation', 'url' => '/chauffage/chaudiere-condensation', 'icon' => '💧', 'desc' => 'Haute performance'],
  ['label' => 'Poêle à Granulés', 'url' => '/chauffage/poele-granules', 'icon' => '🌿', 'desc' => 'Chauffage bois'],
];
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= e($seo['title'] ?? $brand) ?></title>
  <meta name="description" content="<?= e($seo['description'] ?? '') ?>" />
  <link rel="canonical" href="<?= e($seo['url'] ?? '') ?>" />
  <meta property="og:type" content="business.business" />
  <meta property="og:title" content="<?= e($seo['title'] ?? '') ?>" />
  <meta property="og:description" content="<?= e($seo['description'] ?? '') ?>" />
  <meta property="og:url" content="<?= e($seo['url'] ?? '') ?>" />
  <meta property="og:site_name" content="Chauffage-Vosges" />
  <meta property="og:locale" content="fr_FR" />
  <meta name="theme-color" content="#6BAF92" />
  <link rel="preload" href="/assets/styles-green.css" as="style" />
  <link rel="stylesheet" href="/assets/styles-green.css" />
  <link rel="icon" href="/assets/favicon.svg" type="image/svg+xml" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
  <script>document.documentElement.classList.add('js');</script>
</head>
<body>
  <!-- Top Bar -->
  <div class="top-bar">
    <div class="container top-bar__inner">
      <div class="top-bar__left">
        <span class="top-bar__item"><span>📍</span> Intervention dans tout le 88</span>
        <span class="top-bar__item hide-mobile"><span>⚡</span> Devis sous 24h</span>
        <span class="top-bar__item hide-mobile"><span>🏆</span> Certifié RGE QualiPAC</span>
      </div>
      <div class="top-bar__right">
        <?php if ($phone): ?>
          <a href="tel:<?= e(preg_replace('/\s+/', '', $phone)) ?>" class="top-bar__phone">
            <span>📞</span> <?= e($phone) ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Header -->
  <header class="header-modern">
    <div class="container header-modern__inner">
      <a class="brand-modern" href="/" aria-label="Accueil Chauffage-Vosges">
        <div class="brand-modern__logo">
          <span class="brand-modern__icon">🌿</span>
        </div>
        <div class="brand-modern__text">
          <span class="brand-modern__name">Chauffage-Vosges</span>
          <span class="brand-modern__tagline">Expert chauffage dans les Vosges</span>
        </div>
      </a>

      <!-- Navigation SEO optimisée -->
      <nav class="nav-modern" aria-label="Navigation principale">
        <div class="nav-modern__dropdown">
          <button class="nav-modern__link nav-modern__link--dropdown" aria-expanded="false">
            <span>Nos Services</span>
            <span>▼</span>
          </button>
          <div class="nav-modern__mega-menu">
            <div class="nav-modern__mega-grid">
              <?php foreach ($heatingServices as $service): ?>
                <a href="/chauffage/<?= e($service['slug']) ?>" class="nav-modern__mega-item">
                  <span class="nav-modern__mega-icon"><?= $service['icon'] ?></span>
                  <div class="nav-modern__mega-content">
                    <span class="nav-modern__mega-title"><?= e($service['title']) ?></span>
                    <span class="nav-modern__mega-desc"><?= e($service['short_desc'] ?? substr($service['description'], 0, 50) . '...') ?></span>
                  </div>
                </a>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        
        <a href="/communes" class="nav-modern__link">Zones d'intervention</a>
        <a href="/contact" class="nav-modern__cta">Devis Gratuit</a>
      </nav>

      <button class="mobile-menu-btn" aria-label="Menu" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </header>

  <!-- Mobile Menu -->
  <div class="mobile-menu" aria-hidden="true">
    <div class="mobile-menu__content">
      <div class="mobile-menu__section">
        <h3 class="mobile-menu__title">Nos Services Chauffage</h3>
        <div class="mobile-menu__grid">
          <?php foreach ($heatingServices as $service): ?>
            <a href="/chauffage/<?= e($service['slug']) ?>" class="mobile-menu__item">
              <span class="mobile-menu__item-icon"><?= $service['icon'] ?></span>
              <span class="mobile-menu__item-text"><?= e($service['title']) ?></span>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="mobile-menu__section">
        <a href="/communes" class="mobile-menu__link">🗺️ Zones d'intervention</a>
        <a href="/contact" class="mobile-menu__cta">📋 Devis Gratuit</a>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <main class="main">
    <div class="container">
      <?php if ($sent): ?>
        <div class="notice success">
          <strong>✅ Message envoyé !</strong> Nous vous recontactons sous 24h.
        </div>
      <?php endif; ?>
      <?php require $tpl; ?>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer-modern">
    <div class="container">
      <div class="footer-modern__grid">
        <div class="footer-modern__brand">
          <a href="/" class="footer-modern__logo">
            <span class="footer-modern__logo-icon">🌿</span>
            <span class="footer-modern__logo-text">Chauffage-Vosges</span>
          </a>
          <p class="footer-modern__desc">
            Expert en installation et dépannage de chauffage dans les Vosges (88). 
            Devis gratuit et intervention rapide.
          </p>
          <div class="footer-modern__badges">
            <span class="footer-badge">🏆 RGE QualiPAC</span>
            <span class="footer-badge">✓ Qualibat</span>
            <span class="footer-badge">⚡ Devis 24h</span>
          </div>
        </div>
        
        <div class="footer-modern__col">
          <h4 class="footer-modern__title">Solutions Chauffage</h4>
          <ul class="footer-modern__list">
            <li><a href="/chauffage/chaudiere-gaz">Chaudière Gaz</a></li>
            <li><a href="/chauffage/chaudiere-condensation">Chaudière Condensation</a></li>
            <li><a href="/chauffage/pompe-a-chaleur">Pompe à Chaleur</a></li>
            <li><a href="/chauffage/poele-granules">Poêle à Granulés</a></li>
          </ul>
        </div>
        
        <div class="footer-modern__col">
          <h4 class="footer-modern__title">Plus de services</h4>
          <ul class="footer-modern__list">
            <li><a href="/chauffage/chaudiere-electrique">Chaudière Électrique</a></li>
            <li><a href="/chauffage/chaudiere-fioul">Chaudière Fioul</a></li>
            <li><a href="/chauffage/radiateur-electrique">Radiateur Électrique</a></li>
            <li><a href="/chauffage/plancher-chauffant">Plancher Chauffant</a></li>
          </ul>
        </div>
        
        <div class="footer-modern__col">
          <h4 class="footer-modern__title">Contact</h4>
          <address class="footer-modern__address">
            <strong>Intervention sur tout le 88</strong><br>
            <?= $address['city'] ?? 'Épinal' ?>, <?= $address['postal_code'] ?? '88000' ?><br>
            <?php if ($phone): ?>
              <a href="tel:<?= e(preg_replace('/\s+/', '', $phone)) ?>" class="footer-modern__phone">
                <?= e($phone) ?>
              </a>
            <?php endif; ?>
          </address>
          <div class="footer-modern__hours">
            Lun-Ven : 7h30-19h<br>
            Sam : 8h-17h<br>
            <span style="color: var(--primary-green);">Urgence : 7j/7</span>
          </div>
        </div>
      </div>
      
      <div class="footer-modern__bottom">
        <p>&copy; <?= date('Y') ?> Chauffage-Vosges.fr - Tous droits réservés</p>
        <div class="footer-modern__links">
          <a href="/mentions-legales">Mentions légales</a>
          <a href="/politique-confidentialite">Confidentialité</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Sticky Mobile Bar -->
  <div class="sticky-mobile-bar">
    <a href="/contact" class="sticky-mobile-bar__btn sticky-mobile-bar__btn--primary">
      📝 Devis Gratuit
    </a>
    <?php if ($phone): ?>
    <a href="tel:<?= e(preg_replace('/\s+/', '', $phone)) ?>" class="sticky-mobile-bar__btn sticky-mobile-bar__btn--secondary">
      📞 Appeler
    </a>
    <?php endif; ?>
  </div>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
  <script src="/assets/app.js" defer></script>
</body>
</html>
