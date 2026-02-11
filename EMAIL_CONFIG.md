# Configuration Email - Documentation

## Résumé des modifications

### Formulaire de contact amélioré (templates/contact.php)
- ✅ Formulaire centré sur la page avec un design moderne
- ✅ Trust points (badges de confiance) ajoutés sous le titre
- ✅ Design épuré et professionnel
- ✅ Responsive sur mobile

### Section téléphone centrée (toutes les pages)
- ✅ Nouvelle section `phone-cta-section` créée
- ✅ Design centré avec une boîte distinctive
- ✅ Icône téléphone en grand
- ✅ Numéro cliquable avec style bouton
- ✅ Horaires affichés clairement
- ✅ Ajouté sur toutes les pages : home, city, service, communes, contact

### CSS ajouté (public/assets/styles.css)
- Styles pour le formulaire de contact centré
- Styles pour la section téléphone
- Styles pour les trust points
- Responsive design pour mobile

## Configuration Email actuelle

### Fichier : config.php
```php
'lead_to_email' => 'contact@chauffage-vosges.fr',
```

### Fichier : app/Mailer.php
Le système utilise la fonction PHP `mail()` native pour envoyer les emails.

**Configuration requise sur le serveur :**
1. La fonction `mail()` PHP doit être activée
2. Un serveur SMTP configuré (sendmail ou équivalent)
3. Les enregistrements SPF/DKIM configurés pour éviter les spams

### Format des emails reçus
- **Objet** : `[Chaudière Vosges] Nouveau message - [Ville]`
- **Expéditeur** : no-reply@chauffage-vosges.fr
- **Reply-To** : Email du client
- **Contenu** : Nom, Email, Téléphone, Service, Ville, Message, IP

## Recommandations importantes

### 1. Configuration serveur email
Pour que les emails arrivent correctement :

```bash
# Vérifier que mail() fonctionne
php -r "mail('test@votreemail.com', 'Test', 'Message test');"
```

### 2. Enregistrements DNS recommandés

**SPF Record** (pour éviter les spams) :
```
v=spf1 a mx include:_spf.google.com ~all
```

**DKIM** : Configurer avec votre hébergeur

### 3. Email de test
Avant mise en production, tester l'envoi d'email avec le formulaire.

### 4. Alternative recommandée : SMTP
Pour une fiabilité accrue, remplacer la fonction `mail()` par PHPMailer avec SMTP :

```php
// Exemple avec PHPMailer
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com'; // ou votre SMTP
$mail->SMTPAuth = true;
$mail->Username = 'votre@email.com';
$mail->Password = 'votre-mot-de-passe';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
```

## Pages modifiées

1. **templates/contact.php** - Formulaire centré + section téléphone
2. **templates/home.php** - Section téléphone centrée en bas
3. **templates/city.php** - Section téléphone centrée en bas
4. **templates/chauffage/service.php** - Section téléphone centrée en bas
5. **templates/communes.php** - Section téléphone centrée en bas
6. **public/assets/styles.css** - Styles CSS ajoutés

## Vérification post-déploiement

- [ ] Tester le formulaire de contact
- [ ] Vérifier la réception des emails
- [ ] Tester le lien téléphone sur mobile
- [ ] Vérifier l'affichage responsive
- [ ] Configurer les enregistrements SPF/DKIM si nécessaire
