<section class="section">
  <div class="section__head">
    <h1>Politique de confidentialité</h1>
    <p class="muted">Transparence sur la collecte et l’usage des données (formulaire de contact).</p>
  </div>

  <div class="prose">
    <h2>Responsable du traitement</h2>
    <p><strong><?= e($config['brand'] ?? '') ?></strong> — contact : <?= e($config['lead_to_email'] ?? '') ?>.</p>

    <h2>Données collectées</h2>
    <p>Nom, email, téléphone, commune et message via le formulaire.</p>

    <h2>Finalité & base légale</h2>
    <p>Traitement de votre demande de devis/contact et suivi. Base légale : consentement et/ou mesures précontractuelles selon le contexte.</p>

    <h2>Destinataires</h2>
    <p>Accès limité aux personnes en charge du traitement des demandes.</p>

    <h2>Durée de conservation</h2>
    <p>Les demandes sont conservées le temps nécessaire au traitement commercial et administratif, puis supprimées/archivées selon obligations légales.</p>

    <h2>Vos droits</h2>
    <p>Vous disposez de droits d’accès, rectification, suppression, limitation et opposition. Pour exercer vos droits, contactez-nous : <?= e($config['lead_to_email'] ?? '') ?>. Vous pouvez aussi déposer une plainte auprès de la CNIL.</p>

    <h2>Cookies</h2>
    <p>Ce site n’utilise pas de cookies de mesure d’audience ou publicitaires par défaut. Si cela change, un bandeau de consentement sera mis en place.</p>
  </div>
</section>
