# 🔒 Plan de Sécurité - Chauffage-Vosges

## 📋 Résumé des vulnérabilités identifiées et solutions

### 🚨 Niveau CRITIQUE (À implémenter immédiatement)

#### 1. Headers HTTP de sécurité manquants
**Risque** : XSS, Clickjacking, MIME sniffing
**Solution** : Ajouter Content-Security-Policy, X-Frame-Options, etc.

#### 2. Session PHP non sécurisée
**Risque** : Hijacking de session, fixation
**Solution** : Regénérer ID, timeout, HTTPOnly cookies

#### 3. Pas de rate limiting
**Risque** : Brute force sur formulaire de contact
**Solution** : Limiter les requêtes par IP

#### 4. Protection répertoires insuffisante
**Risque** : Accès aux fichiers sensibles (config.php, data/)
**Solution** : .htaccess restrictif

### ⚠️ Niveau IMPORTANT (À implémenter rapidement)

#### 5. Logs de sécurité absents
**Risque** : Impossible de détecter les attaques
**Solution** : Système de logging des accès suspects

#### 6. Pas de validation d'input renforcée
**Risque** : Injection de code, path traversal
**Solution** : Validation stricte des paramètres GET/POST

#### 7. HSTS manquant
**Risque** : Downgrade HTTPS vers HTTP
**Solution** : Header Strict-Transport-Security

---

## 🛡️ Implémentations de sécurité

### A. Headers de sécurité HTTP

Ajouter dans `public/.htaccess` ou via PHP :

```apache
# Protection contre le clickjacking
Header always set X-Frame-Options "SAMEORIGIN"

# Protection XSS
Header always set X-XSS-Protection "1; mode=block"

# Empêcher MIME sniffing
Header always set X-Content-Type-Options "nosniff"

# Politique de sécurité du contenu
Header always set Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline' https://unpkg.com https://fonts.googleapis.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://unpkg.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: https://*.tile.openstreetmap.org; connect-src 'self';"

# Referrer Policy
Header always set Referrer-Policy "strict-origin-when-cross-origin"

# Permissions Policy
Header always set Permissions-Policy "geolocation=(), microphone=(), camera=(), payment=(), usb=(), magnetometer=(), gyroscope=()"

# Strict Transport Security (HTTPS uniquement)
Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains; preload"
```

### B. Sécurisation des sessions

```php
// Dans bootstrap.php ou index.php
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_secure', '1'); // HTTPS uniquement
ini_set('session.cookie_samesite', 'Strict');
ini_set('session.use_strict_mode', '1');
ini_set('session.gc_maxlifetime', '3600'); // 1 heure
```

### C. Rate Limiting

Implémenter un système de limitation par IP :
- 5 requêtes par minute sur /contact
- 10 requêtes par minute globalement
- Blocage temporaire après dépassement

### D. Structure des fichiers de sécurité

```
app/
├── Security/
│   ├── Headers.php      # Gestion des headers
│   ├── RateLimiter.php  # Limitation de requêtes
│   ├── Logger.php       # Logs de sécurité
│   └── Validator.php    # Validation des inputs
├── Csrf.php            # (existant - à améliorer)
└── ...
```

### E. Checklist de déploiement sécurisé

- [ ] HTTPS activé avec certificat valide
- [ ] Headers de sécurité configurés
- [ ] Sessions sécurisées (HTTPOnly, Secure, SameSite)
- [ ] Rate limiting activé
- [ ] Répertoires sensibles protégés (.htaccess)
- [ ] Fichier config.php inaccessible depuis le web
- [ ] Logs de sécurité activés
- [ ] CSRF token sur tous les formulaires
- [ ] Validation des entrées utilisateur
- [ ] Messages d'erreur génériques (pas d'infos système)

---

## 🔍 Monitoring et détection

### Logs à surveiller :
- Tentatives de connexion échouées
- Requêtes suspectes (SQL injection, XSS)
- Scan de répertoires
- Accès aux fichiers sensibles
- Dépassement de rate limit

### Alertes automatiques :
- Email en cas de blocage d'IP
- Notification après 5 erreurs CSRF
- Alerte si fichier config.php accédé

---

## 🚀 Prochaines étapes recommandées

1. **Immédiat** : Configurer headers HTTP + .htaccess
2. **Cette semaine** : Implémenter rate limiting
3. **Ce mois** : Mise en place des logs de sécurité
4. **À terme** : Audit de sécurité externe (pentest)

---

*Document créé le : 11/02/2025*
*Dernière mise à jour : 11/02/2025*
