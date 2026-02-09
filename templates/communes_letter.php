<?php ?>
<nav class="breadcrumbs" aria-label="Fil d'ariane">
  <a href="/">Accueil</a>
  <span aria-hidden="true">›</span>
  <a href="/communes">Communes</a>
  <span aria-hidden="true">›</span>
  <span><?= e($letter) ?></span>
</nav>

<section class="section">
  <div class="section__head">
    <h1>Communes des Vosges – <?= e($letter) ?></h1>
    <p class="muted">Cliquez sur une commune pour ouvrir la page locale (chaudière).</p>
  </div>

  <div class="az" aria-label="Navigation alphabet">
    <?php foreach (range('A','Z') as $L): ?>
      <a class="az__link <?= $L===$letter ? 'is-active' : '' ?>" href="/communes/<?= strtolower(e($L)) ?>"><?= e($L) ?></a>
    <?php endforeach; ?>
  </div>

  <?php if (empty($list)): ?>
    <div class="notice">Aucune commune pour cette lettre.</div>
  <?php else: ?>
    <div class="grid">
      <?php foreach ($list as $c): ?>
        <a class="tile" href="/ville/<?= e($c['slug']) ?>">
          <div class="tile__title"><?= e($c['name']) ?></div>
          <div class="tile__meta"><?= e($c['cp'] ?: 'Vosges') ?></div>
        </a>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <div class="callout">
    <div>
      <strong>Vous ne trouvez pas votre commune ?</strong>
      <div class="muted">Contactez-nous : on intervient sur tout le département 88.</div>
    </div>
    <a class="btn btn--primary" href="/contact">Devis gratuit</a>
  </div>
</section>
