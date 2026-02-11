# 🚀 Guide Complet d'Hébergement - Chauffage-Vosges

## 📋 Résumé des besoins

**Type de site** : Site vitrine avec génération de leads  
**Technologie** : PHP 8.0+, MySQL (optionnel), HTML/CSS/JS  
**Trafic estimé** : 500-5000 visiteurs/jour  
**Stockage** : ~100 Mo (sans cache)  
**Localisation** : France / Europe (SEO local)  
**Budget** : Variable selon option  

---

## 🎯 Options d'hébergement recommandées

### Option 1 : VPS Cloud (RECOMMANDÉ) ⭐⭐⭐⭐⭐

**Hébergeurs recommandés** :
- **OVHcloud** (VPS Starter ou Essential)
- **Scaleway** (Stardust ou DEV1)
- **Hetzner** (CX11 ou CPX11)

**Pourquoi cette option ?**
- ✅ Contrôle total du serveur (root)
- ✅ Isolation complète (pas de voisins bruyants)
- ✅ Configuration sécurité personnalisée
- ✅ Performance optimale pour le SEO (vitesse)
- ✅ Coût maîtrisé (3-10€/mois)
- ✅ Scalabilité facile

**Configuration recommandée** :
```
CPU : 1-2 vCore
RAM : 2-4 Go
SSD : 20-40 Go
Bande passante : 100 Mbps+
Localisation : France (Gravelines/Strasbourg) ou Allemagne
```

---

### Option 2 : Hébergement Mutualisé Pro ⭐⭐⭐⭐

**Hébergeurs recommandés** :
- **OVHcloud** (Hébergement Pro ou Performance)
- **Infomaniak** (Hébergement Pro)
- **PlanetHoster** (World Platform)
- **AlwaysData** (Mutualisé Pro)

**Pourquoi cette option ?**
- ✅ Simplicité de gestion (pas de maintenance serveur)
- ✅ Support technique inclus
- ✅ Certificat SSL gratuit inclus
- ✅ Backups automatiques
- ✅ Idéal pour démarrer rapidement

**Configuration recommandée** :
```
Espace disque : 100 Go+
Bases MySQL : Illimitées
Certificat SSL : Let's Encrypt (auto)
Localisation : France / Suisse
```

---

### Option 3 : Cloud Managé (PREMIUM) ⭐⭐⭐⭐⭐

**Hébergeurs recommandés** :
- **Platform.sh** (Standard)
- **Symfony Cloud** (si framework Symfony)
- **Heroku** (Hobby ou Professional)

**Pourquoi cette option ?**
- ✅ Déploiement continu (CI/CD)
- ✅ Environnements de staging
- ✅ Haute disponibilité (99.99%)
- ✅ Scaling automatique
- ✅ Sécurité managée
- ✅ Coût : 20-50€/mois

---

### Option 4 : Serveur Dédié (Enterprise) ⭐⭐⭐⭐⭐

**Hébergeurs recommandés** :
- **OVHcloud** (Advance ou Rise)
- **Hetzner** (AX42 ou EX42)
- **Online.net** (Dedibox)

**Pourquoi cette option ?**
- ✅ Performances maximales
- ✅ Ressources dédiées 100%
- ✅ Pour sites à fort trafic (>10k/jour)
- ✅ Coût : 30-100€/mois

---

## 🔒 Configuration Sécurité par Hébergeur

### 🔧 OVHcloud VPS

#### 1. Création du serveur
```bash
# Connexion SSH
ssh root@<IP_DU_SERVEUR>

# Mise à jour système
apt update && apt upgrade -y

# Installation des dépendances
apt install -y nginx php8.1-fpm php8.1-mysql php8.1-curl php8.1-gd \
  php8.1-mbstring php8.1-xml php8.1-zip fail2ban ufw certbot \
  python3-certbot-nginx
```

#### 2. Configuration Firewall (UFW)
```bash
# Politique par défaut
ufw default deny incoming
ufw default allow outgoing

# Autoriser SSH (changer le port si possible)
ufw allow 22/tcp

# Autoriser HTTP/HTTPS
ufw allow 80/tcp
ufw allow 443/tcp

# Activer
ufw enable
```

#### 3. Configuration Fail2Ban
```bash
# Copier la configuration
sudo cp /etc/fail2ban/jail.conf /etc/fail2ban/jail.local

# Éditer la configuration
sudo nano /etc/fail2ban/jail.local
```

Contenu à ajouter :
```ini
[DEFAULT]
bantime = 3600
findtime = 600
maxretry = 3

[sshd]
enabled = true
port = 22
filter = sshd
logpath = /var/log/auth.log
maxretry = 3

[nginx-http-auth]
enabled = true
filter = nginx-http-auth
port = http,https
logpath = /var/log/nginx/error.log

[nginx-limit-req]
enabled = true
filter = nginx-limit-req
port = http,https
logpath = /var/log/nginx/error.log

[php-url-fopen]
enabled = true
port = http,https
filter = php-url-fopen
logpath = /var/log/nginx/access.log
```

#### 4. Configuration Nginx sécurisée
```bash
sudo nano /etc/nginx/nginx.conf
```

Contenu à ajouter dans le bloc `http` :
```nginx
# Headers de sécurité
add_header X-Frame-Options "SAMEORIGIN" always;
add_header X-Content-Type-Options "nosniff" always;
add_header X-XSS-Protection "1; mode=block" always;
add_header Referrer-Policy "strict-origin-when-cross-origin" always;
add_header Permissions-Policy "geolocation=(), microphone=(), camera=()" always;

# Protection contre les attaques
limit_req_zone $binary_remote_addr zone=one:10m rate=10r/s;
limit_conn_zone $binary_remote_addr zone=addr:10m;

# Masquer la version nginx
server_tokens off;

# Taille max upload
client_max_body_size 10M;

# Timeouts
client_body_timeout 12;
client_header_timeout 12;
keepalive_timeout 15;
send_timeout 10;
```

#### 5. Configuration SSL/TLS (Let's Encrypt)
```bash
# Obtenir le certificat
certbot --nginx -d chauffage-vosges.fr -d www.chauffage-vosges.fr

# Renouvellement automatique
certbot renew --dry-run
```

#### 6. Configuration PHP-FPM sécurisée
```bash
sudo nano /etc/php/8.1/fpm/php.ini
```

Modifications à apporter :
```ini
; Sécurité
disable_functions = exec,passthru,shell_exec,system,proc_open,popen,curl_exec,curl_multi_exec,parse_ini_file,show_source
expose_php = Off
allow_url_fopen = Off
allow_url_include = Off

; Limites
max_execution_time = 30
max_input_time = 30
max_input_vars = 1000
memory_limit = 128M
upload_max_filesize = 10M
post_max_size = 10M

; Erreurs (désactiver en production)
display_errors = Off
log_errors = On
error_log = /var/log/php_errors.log
```

---

### 🔧 Infomaniak (Mutualisé Pro)

#### Configuration via Panel

1. **Activer HTTPS** :
   - Panel → Sites → Gestion SSL → Activer Let's Encrypt

2. **Configurer PHP** :
   - Panel → Hébergement → Version PHP → 8.1
   - Activer les extensions : curl, gd, mbstring, xml

3. **Sécurité** :
   - Panel → Sécurité → Protection DDoS (activée par défaut)
   - Panel → Sauvegardes → Activer les backups automatiques

4. **.htaccess spécifique Infomaniak** :
```apache
# Compression
AddOutputFilterByType DEFLATE text/html text/css text/javascript

# Cache navigateur
<IfModule mod_expires.c>
  ExpiresActive On
  ExpiresByType text/css "access plus 1 month"
  ExpiresByType application/javascript "access plus 1 month"
</IfModule>

# Protection
Options -Indexes
Header set X-Frame-Options "SAMEORIGIN"
Header set X-Content-Type-Options "nosniff"
Header set X-XSS-Protection "1; mode=block"
```

---

### 🔧 Platform.sh (Cloud Managé)

#### Configuration `.platform.app.yaml`
```yaml
name: app
type: php:8.1

runtime:
  extensions:
    - curl
    - gd
    - mbstring
    - xml

disk: 512

mounts:
  'storage/cache':
    source: local
    source_path: cache
  'storage/logs':
    source: local
    source_path: logs
  'storage/leads':
    source: local
    source_path: leads

web:
  locations:
    '/':
      root: 'public'
      passthru: '/index.php'
      index:
        - index.php
      allow: true
      headers:
        X-Frame-Options: SAMEORIGIN
        X-Content-Type-Options: nosniff

variables:
  php:
    display_errors: Off
    expose_php: Off
    memory_limit: 128M

hooks:
  build: |
    composer install --no-dev --optimize-autoloader
  deploy: |
    mkdir -p storage/logs storage/cache storage/leads
    chmod -R 750 storage
```

---

## 🌐 Optimisations SEO par Hébergement

### 1. CDN (Content Delivery Network)

**Recommandation** : **Cloudflare** (Plan Gratuit suffisant)

#### Avantages pour le SEO :
- ⚡ **Vitesse** : Cache global + compression
- 🔒 **HTTPS** : SSL gratuit et forcé
- 🛡️ **Sécurité** : Protection DDoS + WAF
- 📊 **Analytics** : Statistiques de trafic

#### Configuration Cloudflare :
1. Créer un compte sur cloudflare.com
2. Ajouter le domaine `chauffage-vosges.fr`
3. Modifier les DNS chez le registrar :
   ```
   lara.ns.cloudflare.com
   greg.ns.cloudflare.com
   ```
4. Configurer dans Cloudflare :
   - SSL/TLS : Full (strict)
   - Auto Minify : CSS, JS, HTML
   - Brotli : ON
   - Always Use HTTPS : ON
   - Automatic HTTPS Rewrites : ON

#### Règles de cache pour WordPress/PHP :
```
Page Rules :
1. chauffage-vosges.fr/wp-admin/* → Cache Level: Bypass
2. chauffage-vosges.fr/* → Cache Level: Cache Everything, Edge Cache TTL: 2 hours
```

---

### 2. DNS Optimisé

**Hébergeurs DNS recommandés** :
1. **Cloudflare DNS** (Gratuit, rapide)
2. **Google Cloud DNS** (Premium, fiable)
3. **Amazon Route 53** (Pay-per-use)

#### Configuration DNS type :
```
; A Records
@     3600    IN    A       <IP_SERVEUR>
www   3600    IN    A       <IP_SERVEUR>

; CNAME Records
mail  3600    IN    CNAME   mail.infomaniak.ch.

; MX Records
@     3600    IN    MX      10 mail.infomaniak.ch.

; TXT Records (SPF, DKIM, DMARC)
@     3600    IN    TXT     "v=spf1 include:mail.infomaniak.ch ~all"
_dmarc 3600   IN    TXT     "v=DMARC1; p=quarantine; rua=mailto:dmarc@chauffage-vosges.fr"
```

---

### 3. Performance Web (Core Web Vitals)

#### Outils de test :
- Google PageSpeed Insights
- GTmetrix
- WebPageTest
- Lighthouse

#### Objectifs SEO (Google) :
```
LCP (Largest Contentful Paint) : < 2.5s
FID (First Input Delay) : < 100ms
CLS (Cumulative Layout Shift) : < 0.1
FCP (First Contentful Paint) : < 1.8s
TTFB (Time To First Byte) : < 600ms
```

#### Optimisations serveur :

**1. Compression Brotli/Gzip** (déjà dans .htaccess)

**2. HTTP/2 ou HTTP/3** :
```nginx
# Dans nginx.conf
server {
    listen 443 ssl http2;
    # ou pour HTTP/3
    listen 443 quic reuseport;
}
```

**3. Cache serveur** :
```nginx
# Cache Nginx pour pages statiques
location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg)$ {
    expires 1y;
    add_header Cache-Control "public, immutable";
}
```

**4. Préconnexion** (dans HTML `<head>`) :
```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="dns-prefetch" href="https://unpkg.com">
```

---

## 💾 Stratégie de Sauvegarde

### Sauvegardes automatiques (tous les hébergeurs)

#### Option 1 : Script Bash (VPS)
```bash
#!/bin/bash
# /root/backup.sh

DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/backup"
SITE_DIR="/var/www/chauffage-vosges"
DB_NAME="chaudiere"
RETENTION_DAYS=30

# Créer le répertoire
mkdir -p $BACKUP_DIR

# Sauvegarde fichiers
tar -czf $BACKUP_DIR/files_$DATE.tar.gz -C $SITE_DIR .

# Sauvegarde base de données (si utilisée)
mysqldump -u root -p'PASSWORD' $DB_NAME > $BACKUP_DIR/db_$DATE.sql

# Compression
gzip $BACKUP_DIR/db_$DATE.sql

# Upload vers stockage externe (S3, FTP, etc.)
# rclone copy $BACKUP_DIR remote:backups/

# Suppression anciennes sauvegardes
find $BACKUP_DIR -name "*.tar.gz" -mtime +$RETENTION_DAYS -delete
find $BACKUP_DIR -name "*.sql.gz" -mtime +$RETENTION_DAYS -delete

echo "Backup completed: $DATE"
```

Crontab (tous les jours à 2h du matin) :
```bash
0 2 * * * /root/backup.sh >> /var/log/backup.log 2>&1
```

#### Option 2 : Solutions managées
- **OVHcloud** : Sauvegardes automatiques (option à 5€/mois)
- **JetBackup** (cPanel) : Sauvegardes externalisées
- **BackupBuddy** (WordPress) : Plugin de backup

---

## 📊 Monitoring et Alertes

### Outils recommandés

#### 1. Uptime Monitoring (Gratuit)
- **UptimeRobot** (50 moniteurs gratuits)
- **StatusCake** (Tests depuis multiples localisations)
- **Pingdom** (1 site gratuit)

Configuration UptimeRobot :
```
URL : https://chauffage-vosges.fr
Intervalle : 5 minutes
Type : HTTP(s)
Alertes : Email + SMS
```

#### 2. Performance Monitoring
- **New Relic** (14 jours gratuit)
- **Blackfire.io** (Profiling PHP)
- **GTmetrix** (Monitoring régulier)

#### 3. Logs et Sécurité
- **Splunk** (Analyse logs)
- **GoAccess** (Analyse temps réel des logs)
- **Fail2Ban** (déjà configuré)

Installation GoAccess :
```bash
apt install goaccess
goaccess /var/log/nginx/access.log -o report.html --real-time-html
```

---

## 🎯 Configuration complète par type de site

### Scénario 1 : Site Vitrine (RECOMMANDÉ)

**Hébergement** : VPS OVHcloud Starter (3.50€/mois)  
**CDN** : Cloudflare (Gratuit)  
**Email** : Infomaniak WorkSpace (2.50€/mois)  
**Backup** : Automatique OVH (5€/mois)

**Coût total** : ~11€/mois

### Scénario 2 : Site avec Fort Trafic

**Hébergement** : VPS OVHcloud Essential (7.50€/mois)  
**CDN** : Cloudflare Pro (20€/mois)  
**Load Balancer** : OVHcloud (10€/mois)  
**Monitoring** : UptimeRobot Pro (7€/mois)

**Coût total** : ~45€/mois

### Scénario 3 : Enterprise (99.99% SLA)

**Hébergement** : Platform.sh (50€/mois)  
**CDN** : Cloudflare Enterprise (Contact)  
**DNS** : Amazon Route 53  
**Monitoring** : Datadog

**Coût total** : À partir de 100€/mois

---

## 🔧 Checklist de mise en production

### Avant le lancement

- [ ] **Serveur** : Mise à jour système complète
- [ ] **SSL** : Certificat installé et testé (SSL Labs A+)
- [ ] **Headers** : Tous les headers de sécurité présents
- [ ] **Firewall** : Ports ouverts uniquement nécessaires (80, 443, 22)
- [ ] **Fail2Ban** : Actif et configuré
- [ ] **Backup** : Script testé et fonctionnel
- [ ] **Monitoring** : UptimeRobot configuré
- [ ] **CDN** : Cloudflare actif avec cache
- [ ] **DNS** : Propagation complète (vérifier avec dig/nslookup)
- [ ] **SEO** : Sitemap soumis à Google Search Console
- [ ] **Performance** : Score PageSpeed > 90
- [ ] **Sécurité** : Test avec securityheaders.com (score A)
- [ ] **Formulaire** : Test d'envoi + réception email
- [ ] **Mobile** : Test responsive sur plusieurs devices

### Tests finaux

```bash
# Test SSL
curl -I https://chauffage-vosges.fr

# Test headers de sécurité
curl -I https://chauffage-vosges.fr | grep -i "x-"

# Test compression
curl -H "Accept-Encoding: gzip" -I https://chauffage-vosges.fr

# Test DNS
dig chauffage-vosges.fr

# Test performance
# Utiliser : https://pagespeed.web.dev/
```

---

## 📞 Support et Documentation

### Ressources utiles

**Documentation** :
- [Nginx Documentation](https://nginx.org/en/docs/)
- [PHP Security Best Practices](https://www.php.net/manual/en/security.php)
- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [Let's Encrypt Documentation](https://letsencrypt.org/docs/)

**Communautés** :
- Reddit r/webhosting
- Stack Overflow (tags: nginx, php, security)
- Discord Infomaniak / OVHcloud

### Contacts support

**OVHcloud** : 
- Téléphone : 1007 (depuis la France)
- Ticket : Espace client

**Infomaniak** :
- Téléphone : +41 22 820 35 44
- Chat : Disponible 7j/7

**Cloudflare** :
- Communauté : community.cloudflare.com
- Support Pro : Via dashboard

---

## 🎓 Formation continue

### Pour aller plus loin

1. **Certifications recommandées** :
   - CompTIA Security+
   - AWS Cloud Practitioner
   - Google Cloud Professional

2. **Outils à maîtriser** :
   - Docker (conteneurisation)
   - Kubernetes (orchestration)
   - Terraform (Infrastructure as Code)
   - Ansible (automatisation)

3. **Veille sécurité** :
   - Suivre @scaphr sur Twitter
   - Newsletter SSI (ANSSI)
   - Blog Cloudflare

---

**Document créé le** : 11/02/2025  
**Version** : 1.0  
**Mainteneur** : Équipe Chauffage-Vosges  

---

*Ce guide est évolutif. N'hésitez pas à l'adapter selon vos besoins spécifiques et les évolutions des technologies.*
