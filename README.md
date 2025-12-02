# 📰 Mini Mag - Magazine en Ligne (PHP/MySQL)

[![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)](https://developer.mozilla.org/fr/docs/Web/HTML)
[![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)](https://developer.mozilla.org/fr/docs/Web/CSS)
[![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)](https://developer.mozilla.org/fr/docs/Web/JavaScript)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Responsive](https://img.shields.io/badge/Responsive-Design-00D9FF?style=for-the-badge)](https://www.w3.org/)

Un mini magazine en ligne **dynamique** avec gestion de contenu, système de likes et commentaires, développé en **HTML5, CSS3, JavaScript natif, PHP et MySQL** dans le cadre d'un projet académique.

## 📋 Table des matières

- [Aperçu](#aperçu)
- [Fonctionnalités](#fonctionnalités)
- [Technologies](#technologies)
- [Structure du projet](#structure-du-projet)
- [Installation](#installation)
- [Configuration](#configuration)
- [Utilisation](#utilisation)
- [Interface d'administration](#interface-dadministration)
- [API](#api)
- [Captures d'écran](#captures-décran)
- [Caractéristiques techniques](#caractéristiques-techniques)
- [Sécurité](#sécurité)
- [Auteurs](#auteurs)

## 🎯 Aperçu

**Mini Mag** est un magazine en ligne **dynamique** présentant des articles organisés par catégories (Culture, Tech, Voyage). Le site offre une expérience utilisateur fluide avec des animations subtiles, un design responsive, et une **interface d'administration complète** pour gérer le contenu.

### 🆕 Nouveautés de la version PHP

- ✅ **Gestion dynamique des articles** depuis une base de données MySQL
- ✅ **Interface d'administration** complète (CRUD d'articles)
- ✅ **Système de likes** persistant par adresse IP
- ✅ **Commentaires** enregistrés en base de données
- ✅ **API REST** pour la communication JavaScript ↔ PHP
- ✅ **Authentification** sécurisée pour l'admin
- ✅ **Formulaire de contact** fonctionnel avec validation

## ✨ Fonctionnalités

### Frontend
- 📱 **Responsive Design** : Adaptation automatique sur mobile, tablette et desktop
- 🎨 **Design moderne** : Interface épurée avec effet glassmorphism
- 🔍 **Effet zoom** : Animation au survol des images d'articles (scale 1.08)
- 🎯 **CSS Grid** : Grille flexible avec auto-fit pour un layout intelligent
- ♿ **Accessibilité** : Respect des standards WCAG avec attributs ARIA
- ⚡ **Performance** : Transitions CSS optimisées avec GPU acceleration
- 🎭 **Navigation** : Header sticky avec effet de transparence
- 🎠 **Carrousel interactif** : Défilement d'images avec boutons de navigation
- 💬 **Témoignages animés** : Rotation automatique toutes les 5 secondes

### Backend (PHP/MySQL)
- 🗄️ **Base de données MySQL** : Stockage persistant des articles, likes et commentaires
- 👤 **Authentification** : Système de connexion sécurisé pour l'admin
- 📝 **CRUD complet** : Créer, lire, modifier et supprimer des articles
- 👍 **Likes** : Un like par IP avec compteur en temps réel
- 💬 **Commentaires** : Système de commentaires avec nom et message
- 📊 **Tableau de bord** : Statistiques en temps réel (articles, likes, commentaires)
- 🔒 **Sécurité** : Protection XSS, injections SQL, sessions sécurisées
- 🔗 **API REST** : Communication asynchrone via fetch() JavaScript

## 🛠️ Technologies

### Frontend
- **HTML5** : Structure sémantique et accessible
- **CSS3** : Styles modernes (Grid, Flexbox, clamp, backdrop-filter)
- **JavaScript Vanilla** : Interactions dynamiques sans framework
- **AJAX (Fetch API)** : Communication asynchrone avec le serveur

### Backend
- **PHP 7.4+** : Langage serveur natif
- **MySQL 8.0+** : Base de données relationnelle
- **PDO** : Requêtes préparées contre les injections SQL
- **Sessions PHP** : Gestion de l'authentification

### Outils
- **Unsplash API** : Images haute qualité optimisées
- **Polices système** : Performance optimale sans chargement externe

## 📁 Structure du projet

```
mini-mag/
├── index.php                    # Page d'accueil dynamique (PHP)
├── article.php                  # Page d'article individuelle
├── config.php                   # Configuration BDD et fonctions utilitaires
├── api.php                      # API REST pour JavaScript ↔ PHP
├── styles.css                   # Feuille de styles unique
├── admin/
│   ├── login.php               # Connexion administrateur
│   ├── index.php               # Tableau de bord admin
│   ├── add_article.php         # Ajouter un article
│   ├── edit_article.php        # Modifier un article
│   ├── delete_article.php      # Supprimer un article (AJAX)
│   └── logout.php              # Déconnexion
└── database/
    └── structure.sql           # Structure de la base de données
```

## 🚀 Installation

### Prérequis

- **Serveur web** : Apache/Nginx avec PHP 7.4+
- **Base de données** : MySQL 8.0+ ou MariaDB 10.3+
- **Outils** : XAMPP, WAMP, MAMP ou équivalent
- **Éditeur de code** : VS Code recommandé

### Étapes d'installation

#### 1. Cloner le repository

```bash
git clone https://github.com/fouratjebali/Mini-Projet.git
cd Mini-Projet
```

#### 2. Créer la base de données

```bash
# Se connecter à MySQL
mysql -u root -p

# Créer la base
CREATE DATABASE mini_mag CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# Utiliser la base
USE mini_mag;

# Importer la structure
source database/structure.sql;
```

**Ou via phpMyAdmin** :
1. Créer une nouvelle base `mini_mag`
2. Importer le fichier `database/structure.sql`

#### 3. Configurer la connexion

Modifier `config.php` avec vos paramètres :

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'mini_mag');
define('DB_USER', 'root');        // Votre utilisateur MySQL
define('DB_PASS', '');            // Votre mot de passe MySQL
```

#### 4. Lancer le serveur

**Avec PHP intégré :**
```bash
php -S localhost:8000
```

**Avec XAMPP/WAMP :**
1. Placer le projet dans `htdocs/` ou `www/`
2. Accéder à `http://localhost/mini-mag/`

## ⚙️ Configuration

### Compte administrateur par défaut

- **Username** : `admin`
- **Password** : `admin123`

⚠️ **Important** : Changez ce mot de passe en production !

Pour créer un nouveau mot de passe haché :

```php
<?php
echo password_hash('votre_nouveau_mot_de_passe', PASSWORD_DEFAULT);
?>
```

Puis mettez à jour la table `admins` :

```sql
UPDATE admins 
SET password = '$2y$10$VoTrEhAcHeGéNéRé...' 
WHERE username = 'admin';
```

### Base de données

La structure comprend **4 tables** :

1. **articles** : Stocke les articles (titre, contenu, image, auteur, date, slug)
2. **likes** : Enregistre les likes par article et IP
3. **commentaires** : Gestion des commentaires (article_id, nom, message, date)
4. **admins** : Comptes administrateurs (username, password haché, email)

## 💻 Utilisation

### Site public

1. **Page d'accueil** : `http://localhost:8000/index.php`
   - Affiche tous les articles depuis la base de données
   - Carrousel d'images, témoignages, formulaire de contact

2. **Page article** : `http://localhost:8000/article.php?slug=titre-article`
   - Contenu complet de l'article
   - Bouton "Like" fonctionnel (un like par IP)
   - Système de commentaires en temps réel

### Interface d'administration

1. **Connexion** : `http://localhost:8000/admin/login.php`
   - Identifiants par défaut : `admin` / `admin123`

2. **Tableau de bord** : `http://localhost:8000/admin/index.php`
   - Vue d'ensemble : nombre d'articles, likes, commentaires
   - Liste complète des articles avec actions

3. **Gestion des articles** :
   - **Créer** : Bouton "+ Nouvel article"
   - **Modifier** : Clic sur "Modifier" dans la liste
   - **Supprimer** : Confirmation avant suppression (AJAX)

## 🔌 API

L'API REST (`api.php`) gère la communication JavaScript ↔ PHP.

### Endpoints disponibles

#### GET - Récupérer des données

```javascript
// Récupérer tous les articles
fetch('api.php?action=get_articles')
  .then(r => r.json())
  .then(data => console.log(data.articles));

// Récupérer un article par slug
fetch('api.php?action=get_article&slug=titre-article')
  .then(r => r.json())
  .then(data => console.log(data.article));

// Récupérer les likes d'un article
fetch('api.php?action=get_likes&article_id=1')
  .then(r => r.json())
  .then(data => console.log(data.likes));

// Récupérer les commentaires
fetch('api.php?action=get_comments&article_id=1')
  .then(r => r.json())
  .then(data => console.log(data.comments));
```

#### POST - Envoyer des données

```javascript
// Ajouter un like
const formData = new FormData();
formData.append('article_id', 1);

fetch('api.php?action=add_like', {
  method: 'POST',
  body: formData
})
.then(r => r.json())
.then(data => {
  if (data.success) {
    console.log('Nouveau total:', data.likes);
  }
});

// Ajouter un commentaire
const formData = new FormData();
formData.append('article_id', 1);
formData.append('nom', 'Jean');
formData.append('commentaire', 'Super article !');

fetch('api.php?action=add_comment', {
  method: 'POST',
  body: formData
})
.then(r => r.json())
.then(data => {
  if (data.success) {
    console.log('Commentaire ajouté:', data.comment);
  }
});

// Envoyer le formulaire de contact
const formData = new FormData(document.getElementById('contactForm'));

fetch('api.php?action=contact', {
  method: 'POST',
  body: formData
})
.then(r => r.json())
.then(data => {
  alert(data.message);
});
```

### Format de réponse

Toutes les réponses sont au format JSON :

```json
{
  "success": true,
  "data": { ... },
  "message": "Opération réussie"
}
```

En cas d'erreur :

```json
{
  "success": false,
  "message": "Description de l'erreur"
}
```

## 📸 Captures d'écran

### Page d'accueil
![Page d'accueil](https://github.com/user-attachments/assets/3125fa84-7c76-4f46-a858-9c66a2f299bb)

### Page article avec likes et commentaires
![Page article](#)

### Tableau de bord admin
![Admin dashboard](#)

### Formulaire d'ajout d'article
![Ajout article](#)

## 🎨 Caractéristiques techniques

### Responsive Breakpoints

- **Desktop** : > 1024px (3 colonnes)
- **Tablette** : 768px - 1024px (2 colonnes)
- **Mobile** : < 768px (1 colonne)

### Grid automatique

```css
.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 1rem;
}
```

### Communication JavaScript ↔ PHP

Utilisation de l'API Fetch pour des requêtes asynchrones :

```javascript
// Exemple : Ajouter un like sans recharger la page
async function addLike(articleId) {
  const formData = new FormData();
  formData.append('article_id', articleId);
  
  const response = await fetch('api.php?action=add_like', {
    method: 'POST',
    body: formData
  });
  
  const data = await response.json();
  
  if (data.success) {
    document.querySelector('.like-count').textContent = data.likes;
  } else {
    alert(data.message);
  }
}
```

### Accessibilité

- ✅ Navigation au clavier
- ✅ Attributs ARIA (role, aria-label, aria-current)
- ✅ Textes alternatifs sur toutes les images
- ✅ Contraste WCAG AA
- ✅ Balises sémantiques HTML5
- ✅ Lien "Aller au contenu principal"

### Performance

- ⚡ Images optimisées (format auto, qualité 80)
- ⚡ Preconnect vers Unsplash CDN
- ⚡ Police système (pas de chargement externe)
- ⚡ Transitions GPU-accelerated (transform)
- ⚡ Requêtes préparées PDO (pas de requêtes N+1)
- ⚡ Sessions optimisées

## 🔒 Sécurité

Le projet implémente plusieurs mesures de sécurité :

### Protection XSS
```php
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Utilisation dans les vues
echo e($article['titre']);
```

### Requêtes préparées (SQL Injection)
```php
$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->execute([$id]);
```

### Authentification sécurisée
```php
// Hashage des mots de passe
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Vérification
if (password_verify($inputPassword, $hashedPassword)) {
    // Connexion réussie
}
```

### Sessions
```php
session_start();

// Vérification de l'authentification
function isLoggedIn() {
    return isset($_SESSION['admin_id']);
}
```

### Validation des données
```php
// Côté serveur
if (empty($titre) || empty($contenu)) {
    throw new Exception('Tous les champs sont requis');
}

// Validation email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    throw new Exception('Email invalide');
}
```

## 📝 Cahier des charges

Ce projet répond aux contraintes suivantes :

### Phase 1 - Frontend (✅ Complété)
- [x] Interface type magazine avec plusieurs articles
- [x] Navigation entre pages
- [x] 6 à 9 articles sur la page d'accueil
- [x] CSS Grid pour l'agencement
- [x] Effet zoom au survol des images
- [x] Responsive design (mobile, tablette, desktop)
- [x] HTML5 et CSS3 modernes
- [x] JavaScript modulaire
- [x] Carrousel interactif
- [x] Validation W3C

### Phase 2 - Backend PHP (✅ Complété)
- [x] Gestion complète des articles (CRUD)
- [x] Système de likes persistant
- [x] Commentaires enregistrés en base
- [x] Interface d'administration sécurisée
- [x] Communication JavaScript ↔ PHP (API)
- [x] Base de données MySQL
- [x] Authentification admin
- [x] Code natif (sans framework)

## 🐛 Problèmes connus

- Les images Unsplash peuvent avoir un temps de chargement variable selon la connexion
- Le backdrop-filter peut avoir des problèmes de performance sur certains navigateurs anciens
- Un seul like par IP (utiliser les cookies pour plus de granularité)

## 🚧 Améliorations futures

- [ ] Système de catégories dynamique (gestion depuis l'admin)
- [ ] Barre de recherche avec auto-complétion
- [ ] Mode sombre (dark mode) avec préférence utilisateur
- [ ] Lazy-loading des images
- [ ] Pagination des articles
- [ ] Upload d'images depuis l'admin
- [ ] Système de modération des commentaires
- [ ] Statistiques avancées (vues, articles populaires)
- [ ] Export des données (CSV, PDF)
- [ ] Multi-utilisateurs avec rôles (admin, éditeur, auteur)
- [ ] Notifications par email
- [ ] Cache pour optimiser les performances

## 👥 Auteurs

- **Fourat Jebali** - *Développement complet* - [GitHub](https://github.com/fouratjebali)

## 🎓 Contexte académique

Projet réalisé dans le cadre du module **Développement Web** en **FIA3** à l'**Institut Supérieur des Sciences Appliquées et de Technologie de Sousse (ISSAT Sousse)**.

**Année universitaire** : 2025/2026

**Objectifs pédagogiques** :
- Maîtriser HTML5, CSS3 et JavaScript moderne
- Comprendre l'architecture client-serveur
- Implémenter une API REST
- Gérer une base de données relationnelle
- Sécuriser une application web
- Créer une interface d'administration

## 📄 Licence

Ce projet est un projet académique libre d'utilisation à des fins éducatives.

---

## 📞 Contact

Pour toute question ou suggestion :

- 📧 Email : fouratcs@example.com
- 💼 LinkedIn : [Fourat Jebali]
- 🐙 GitHub : [@fouratjebali](https://github.com/fouratjebali)

---

## 🙏 Remerciements

- [Unsplash](https://unsplash.com/) pour les magnifiques images gratuites
- [MDN Web Docs](https://developer.mozilla.org/) pour la documentation
- [CSS-Tricks](https://css-tricks.com/) pour les tutoriels sur CSS Grid
- [PHP.net](https://www.php.net/) pour la documentation PHP
- [MySQL](https://dev.mysql.com/doc/) pour la documentation de la base de données

---

## 📊 Statistiques du projet

- **Lignes de code** :
  - PHP : ~1200 lignes
  - HTML : ~800 lignes
  - CSS : ~450 lignes
  - JavaScript : ~300 lignes
- **Fichiers** : 15+
- **Tables BDD** : 4
- **Endpoints API** : 8
- **Pages** : 10+

---

⭐ **N'oubliez pas de mettre une étoile si vous aimez ce projet !** ⭐
