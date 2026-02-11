<?php
$errors = $errors ?? [];
$old = $old ?? [];
$city = $city ?? '';
$slug = $slug ?? '';
$services = $config['services'] ?? ['Chauffage', 'Plomberie', 'Électricité', 'Antenne'];

function old(string $k, string $default='') {
  global $old;
  return isset($old[$k]) ? (string)$old[$k] : $default;
}

$brand = $config['brand'] ?? 'LUC Didier';
$email = $config['lead_to_email'] ?? '';
$phone = $config['phone'] ?? '03 29 65 87 55';
$address = $config['address'] ?? [];
$googleReviews = $config['reviews']['google'] ?? ['rating' => 4.9, 'count' => 56];

$trustPoints = [
  ['icon' => '⚡', 'title' => 'Réponse 24h', 'desc' => 'Devis sous 24 heures'],
  ['icon' => '📋', 'title' => 'Devis gratuit', 'desc' => 'Sans engagement'],
  ['icon' => '🏆', 'title' => 'Certifié RGE', 'desc' => 'QualiPAC & Qualibat'],
  ['icon' => '⭐', 'title' => $googleReviews['rating'].'/5 Google', 'desc' => $googleReviews['count'].' avis vérifiés'],
];

$contactFaq = [
  ['q' => 'Combien de temps pour recevoir mon devis ?', 'a' => 'Je vous établis un devis détaillé sous 24 heures après réception de votre demande. Pour les urgences, contactez-moi directement au 03 29 65 87 55.'],
  ['q' => 'Quelles informations dois-je fournir ?', 'a' => 'Décrivez votre problème (marque et modèle pour une chaudière, symptômes observés, photos si possible) ainsi que vos disponibilités. Plus vous êtes précis, plus le devis sera juste.'],
  ['q' => 'Intervenez-vous le week-end ?', 'a' => 'Le samedi matin sur rendez-vous. Pour les urgences (panne de chauffage en hiver, fuite importante), je suis disponible 7j/7 au 03 29 65 87 55.'],
  ['q' => 'Proposez-vous des facilités de paiement ?', 'a' => 'J\'accepte plusieurs modes de paiement : espèces, chèque et carte bancaire. Pour les gros travaux, possibilité de paiement échelonné sans frais.'],
];
?>

<nav class="breadcrumbs" aria-label="Fil d'ariane">
  <a href="/">Accueil</a>
  <span aria-hidden="true">›</span>
  <span>Contact & Devis</span>
</nav>

<section class="section section--contact-hero">
  <div class="section__head section__head--centered">
    <div class="hero__badge" style="display: inline-flex; margin-bottom: 20px;">
      <span class="hero__badge-icon">📋</span>
      <span>Devis gratuit sans engagement</span>
    </div>
    <h1>Contactez <span class="accent">LUC Didier</span></h1>
    <p class="lead lead--large">Demandez votre devis gratuit pour chauffage, plomberie, électricité ou antenne.<br>
    Basé à <strong>Padoux</strong>, j'interviens sur <strong>Épinal, Rambervillers, Thaon-les-Vosges, Bruyères</strong> et environs.</p>
  </div>

  <div class="trust-points-grid">
    <?php foreach ($trustPoints as $point): ?>
      <div class="trust-point">
        <span class="trust-point__icon"><?= $point['icon'] ?></span>
        <div>
          <h3 class="trust-point__title"><?= $point['title'] ?></h3>
          <p class="trust-point__desc"><?= $point['desc'] ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<section class="section">
  <div class="contact-layout">
    <div class="contact-form-wrapper">
      <div class="card">
        <h2 class="card__title">📨 Formulaire de contact</h2>
        <p class="muted" style="margin-bottom: 20px;">Remplissez le formulaire ci-dessous. Je vous recontacte rapidement.</p>

        <?php if (!empty($errors['global'])): ?>
          <div class="notice error"><?= e($errors['global']) ?></div>
        <?php endif; ?>

        <form class="form form--contact" method="post" action="/contact" novalidate>
          <input type="hidden" name="csrf" value="<?= e($csrf) ?>" />
          <input type="text" name="website" value="" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true" />

          <div class="form__grid">
            <div class="field">
              <label for="name">Nom complet *</label>
              <input id="name" name="name" required value="<?= e(old('name')) ?>" autocomplete="name" placeholder="Votre nom" />
              <?php if (!empty($errors['name'])): ?><div class="field__error"><?= e($errors['name']) ?></div><?php endif; ?>
            </div>

            <div class="field">
              <label for="email">Email *</label>
              <input id="email" name="email" type="email" required value="<?= e(old('email')) ?>" autocomplete="email" placeholder="votre@email.fr" />
              <?php if (!empty($errors['email'])): ?><div class="field__error"><?= e($errors['email']) ?></div><?php endif; ?>
            </div>

            <div class="field">
              <label for="phone">Téléphone *</label>
              <input id="phone" name="phone" required value="<?= e(old('phone')) ?>" autocomplete="tel" placeholder="06 12 34 56 78" />
              <?php if (!empty($errors['phone'])): ?><div class="field__error"><?= e($errors['phone']) ?></div><?php endif; ?>
            </div>

            <div class="field">
              <label for="service">Type de service *</label>
              <select id="service" name="service" required>
                <option value="">Sélectionnez...</option>
                <?php foreach ($services as $s): ?>
                  <option value="<?= e($s) ?>" <?= old('service')===$s ? 'selected' : '' ?>><?= e($s) ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="field">
              <label for="city">Ville / Commune</label>
              <input id="city" name="city" placeholder="Ex: Épinal" value="<?= e(old('city', $city)) ?>" />
            </div>

            <div class="field">
              <label for="address">Adresse (facultatif)</label>
              <input id="address" name="address" placeholder="Rue et numéro" value="<?= e(old('address')) ?>" />
            </div>
          </div>

          <div class="field" style="margin-top: 16px;">
            <label for="message">Décrivez votre besoin *</label>
            <textarea id="message" name="message" rows="6" required placeholder="Décrivez votre problème : type d'appareil (marque et modèle pour une chaudière), symptômes observés (panne, fuite, erreur...), âge de l'installation, vos disponibilités pour l'intervention..."><?= e(old('message')) ?></textarea>
            <?php if (!empty($errors['message'])): ?><div class="field__error"><?= e($errors['message']) ?></div><?php endif; ?>
          </div>

          <input type="hidden" name="city_slug" value="<?= e(old('city_slug', $slug)) ?>" />

          <label class="consent" style="margin-top: 20px;">
            <input type="checkbox" name="consent" value="1" <?= old('consent')==='1' ? 'checked' : '' ?> required />
            <span>J'accepte d'être recontacté(e) au sujet de ma demande. J'ai lu et j'accepte la <a href="/politique-confidentialite">politique de confidentialité</a>.</span>
          </label>
          <?php if (!empty($errors['consent'])): ?><div class="field__error"><?= e($errors['consent']) ?></div><?php endif; ?>

          <div class="notice" style="margin-top: 20px; font-size: .9rem;">
            <strong>🔒 Protection de vos données</strong><br>
            <span class="muted">Les informations recueillies sont utilisées exclusivement par <strong><?= e($brand) ?></strong> pour traiter votre demande. Conformément au RGPD, vous disposez d'un droit d'accès, de rectification et de suppression.</span>
          </div>

          <button class="btn btn--primary btn--large" type="submit" style="margin-top: 20px; width: 100%;">📤 Envoyer ma demande</button>
          <p class="muted" style="text-align: center; margin-top: 12px; font-size: .9rem;">⏱️ Réponse garantie sous 24 heures</p>
        </form>
      </div>
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
      <a href="tel:0329658755" class="phone-cta-box__number">
        <span>📞</span> 03 29 65 87 55
      </a>
      <p class="phone-cta-box__hours">
        <strong>Horaires :</strong> Lun-Ven 8h00-18h00 · Sam 8h00-12h00<br>
        <span style="color: var(--color-primary-light);">Urgence : 7j/7</span>
      </p>
    </div>
  </div>
</section>

<section class="section section--faq">
  <div class="section__head section__head--centered">
    <h2>Questions fréquentes</h2>
    <p class="muted">Tout ce que vous devez savoir avant de faire votre demande</p>
  </div>
  <div class="faq-grid">
    <?php foreach ($contactFaq as $faq): ?>
      <details class="faq-item">
        <summary><?= $faq['q'] ?></summary>
        <div class="faq-item__content"><p><?= $faq['a'] ?></p></div>
      </details>
    <?php endforeach; ?>
  </div>
</section>

<section class="section">
  <div class="final-cta">
    <div class="final-cta__content">
      <h2>Une urgence à Padoux ou aux alentours ?</h2>
      <p class="lead">Pour les dépannages urgents (panne de chauffage, fuite d'eau), appelez-moi directement.</p>
    </div>
    <div class="final-cta__actions">
      <a href="tel:0329658755" class="btn btn--primary btn--xlarge">📞 03 29 65 87 55</a>
    </div>
  </div>
</section>
