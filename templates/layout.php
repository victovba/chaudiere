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
  <meta name="theme-color" content="#1a5f7a" />
  <link rel="preload" href="/assets/styles.css" as="style" />
  <link rel="stylesheet" href="/assets/styles.css" />
  <link rel="icon" href="/assets/favicon.svg" type="image/svg+xml" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
  <script>document.documentElement.classList.add('js');</script>
</head>
<body>
  <div class="top-bar">
    <div class="container top-bar__inner">
      <div class="top-bar__left">
        <span class="top-bar__item"><span class="icon">📍</span> Intervention dans tout le 88</span>
        <span class="top-bar__item hide-mobile"><span class="icon">⚡</span> Devis sous 24h</span>
        <span class="top-bar__item hide-mobile"><span class="icon">🏆</span> Installateurs certifiés</span>
      </div>
      <div class="top-bar__right">
        <?php if ($phone): ?>
          <a href="tel:<?= e(preg_replace('/\s+/', '', $phone)) ?>" class="top-bar__phone"><span class="icon">📞</span> <?= e($phone) ?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <header class="header-modern">
    <div class="container header-modern__inner">
      <a class="brand-modern" href="/" aria-label="Accueil">
        <div class="brand-modern__logo"><span class="brand-modern__icon">🔥</span></div>
        <div class="brand-modern__text">
          <span class="brand-modern__name">Chauffage-vosges</span>
          <span class="brand-modern__tagline">Installation & dépannage 88</span>
        </div>
      </a>

      <nav class="nav-modern" aria-label="Navigation principale">
        <div class="nav-modern__dropdown">
          <button class="nav-modern__link nav-modern__link--dropdown">
            <span class="nav-modern__icon">🔥</span>
            <span>Nos solutions</span>
            <span class="nav-modern__arrow">▼</span>
          </button>
          <div class="nav-modern__mega-menu">
            <div class="nav-modern__mega-grid">
              <?php foreach ($heatingServices as $service): ?>
                <a href="/chauffage/<?= e($service['slug']) ?>" class="nav-modern__mega-item">
                  <span class="nav-modern__mega-icon" style="color: <?= $service['color'] ?>"><?= $service['icon'] ?></span>
                  <div class="nav-modern__mega-content">
                    <span class="nav-modern__mega-title"><?= e($service['title']) ?></span>
                    <span class="nav-modern__mega-desc"><?= e($service['description']) ?></span>
                  </div>
                </a>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        <a href="/communes" class="nav-modern__link"><span class="nav-modern__icon">🗺️</span><span>Zones</span></a>
        <a href="/contact" class="nav-modern__cta"><span>Devis gratuit</span></a>
      </nav>

      <button class="mobile-menu-btn" aria-label="Menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </div>
  </header>

  <div class="mobile-menu" aria-hidden="true">
    <div class="mobile-menu__content">
      <div class="mobile-menu__section">
        <h3 class="mobile-menu__title">Nos solutions chauffage</h3>
        <div class="mobile-menu__grid">
          <?php foreach ($heatingServices as $service): ?>
            <a href="/chauffage/<?= e($service['slug']) ?>" class="mobile-menu__item">
              <span class="mobile-menu__item-icon" style="color: <?= $service['color'] ?>"><?= $service['icon'] ?></span>
              <span class="mobile-menu__item-text"><?= e($service['title']) ?></span>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="mobile-menu__section">
        <a href="/communes" class="mobile-menu__link">🗺️ Zones d'intervention</a>
        <a href="/contact" class="mobile-menu__cta">📋 Devis gratuit</a>
      </div>
    </div>
  </div>

  <main class="main">
    <div class="container">
      <?php if ($sent): ?>
        <div class="notice success"><strong>✅ Message envoyé !</strong> Nous vous recontactons sous 24h.</div>
      <?php endif; ?>
      <?php require $tpl; ?>
    </div>
  </main>

  <footer class="footer-modern">
    <div class="container">
      <div class="footer-modern__grid">
        <div class="footer-modern__brand">
          <a href="/" class="footer-modern__logo">
            <span class="footer-modern__logo-icon">🔥</span>
            <span class="footer-modern__logo-text">Chauffage-vosges</span>
          </a>
          <p class="footer-modern__desc">Installation et dépannage de tous types de chauffage dans les Vosges (88).</p>
          <div class="footer-modern__badges">
            <span class="footer-badge">🏆 RGE QualiPAC</span>
            <span class="footer-badge">✓ Qualibat</span>
          </div>
        </div>
        <div class="footer-modern__col">
          <h4 class="footer-modern__title">Solutions</h4>
          <ul class="footer-modern__list">
            <?php foreach (array_slice($heatingServices, 0, 4) as $service): ?>
              <li><a href="/chauffage/<?= e($service['slug']) ?>"><?= e($service['title']) ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="footer-modern__col">
          <h4 class="footer-modern__title">Plus</h4>
          <ul class="footer-modern__list">
            <?php foreach (array_slice($heatingServices, 4, 4) as $service): ?>
              <li><a href="/chauffage/<?= e($service['slug']) ?>"><?= e($service['title']) ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="footer-modern__col">
          <h4 class="footer-modern__title">Contact</h4>
          <address class="footer-modern__address">
            <?= $address['city'] ?? 'Épinal' ?> (88)<br>
            <?php if ($phone): ?>
              <a href="tel:<?= e(preg_replace('/\s+/', '', $phone)) ?>" class="footer-modern__phone"><?= e($phone) ?></a>
            <?php endif; ?>
          </address>
          <div class="footer-modern__hours">Lun-Ven : 7h30-19h<br>Sam : 8h-17h</div>
        </div>
      </div>
      <div class="footer-modern__bottom">
        <p>&copy; <?= date('Y') ?> Chauffage-vosges.fr</p>
        <div class="footer-modern__links">
          <a href="/mentions-legales">Mentions légales</a>
          <a href="/politique-confidentialite">Confidentialité</a>
        </div>
      </div>
    </div>
  </footer>

  <div class="sticky-mobile-bar">
    <a href="/contact" class="sticky-mobile-bar__btn sticky-mobile-bar__btn--primary">📝 Devis</a>
    <?php if ($phone): ?>
    <a href="tel:<?= e(preg_replace('/\s+/', '', $phone)) ?>" class="sticky-mobile-bar__btn sticky-mobile-bar__btn--secondary">📞 Appeler</a>
    <?php endif; ?>
  </div>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
  <script src="/assets/app.js" defer></script>
</body>
</html>
