# 📰 Mini Mag - Magazine en Ligne

[![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)](https://developer.mozilla.org/fr/docs/Web/HTML)
[![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)](https://developer.mozilla.org/fr/docs/Web/CSS)
[![Responsive](https://img.shields.io/badge/Responsive-Design-00D9FF?style=for-the-badge)](https://www.w3.org/)

Un mini magazine en ligne moderne et responsive, développé en HTML5 et CSS3 pur dans le cadre d'un projet académique.

## 📋 Table des matières

- [Aperçu](#aperçu)
- [Fonctionnalités](#fonctionnalités)
- [Technologies](#technologies)
- [Structure du projet](#structure-du-projet)
- [Installation](#installation)
- [Utilisation](#utilisation)
- [Captures d'écran](#captures-décran)
- [Caractéristiques techniques](#caractéristiques-techniques)
- [Validation W3C](#validation-w3c)
- [Auteurs](#auteurs)
- [Licence](#licence)

## 🎯 Aperçu

**Mini Mag** est un magazine en ligne présentant 9 articles organisés par catégories (Culture, Tech, Voyage). Le site offre une expérience utilisateur fluide avec des animations subtiles et un design responsive qui s'adapte à tous les appareils.

🔗 **[Voir la démo en ligne](#)** *(Remplacez par votre lien GitHub Pages)*

## ✨ Fonctionnalités

- 📱 **Responsive Design** : Adaptation automatique sur mobile, tablette et desktop
- 🎨 **Design moderne** : Interface épurée avec effet glassmorphism
- 🔍 **Effet zoom** : Animation au survol des images d'articles (scale 1.08)
- 🎯 **CSS Grid** : Grille flexible avec auto-fit pour un layout intelligent
- ♿ **Accessibilité** : Respect des standards WCAG avec attributs ARIA
- ⚡ **Performance** : Transitions CSS optimisées avec GPU acceleration
- 🎭 **Navigation** : Header sticky avec effet de transparence
- 📰 **9 articles** : Organisés en 3 catégories thématiques

## 🛠️ Technologies

- **HTML5** : Structure sémantique et accessible
- **CSS3** : Styles modernes (Grid, Flexbox, clamp, backdrop-filter)
- **Unsplash API** : Images haute qualité optimisées
- **Polices système** : Performance optimale sans chargement externe

### Propriétés CSS modernes utilisées

```css
- CSS Grid (auto-fit, minmax)
- backdrop-filter (glassmorphism)
- clamp() (typographie responsive)
- aspect-ratio (ratio d'images)
- transform & transition (animations)
- object-fit (recadrage images)
```

## 📁 Structure du projet

```
mini-mag/
├── index.html              # Page d'accueil avec grille de 9 articles
├── styles.css              # Feuille de styles unique (165 lignes)
└── pages/
    ├── article1.html       # Article Culture : Festival local
    ├── article2.html       # Article Tech : IA grand public
    └── article3.html       # Article Voyage : 48h à Naples
```

## 🚀 Installation

### Prérequis

- Un navigateur web moderne (Chrome, Firefox, Safari, Edge)
- Un éditeur de code (VS Code recommandé)
- Extension Live Server (optionnel mais recommandé)

### Étapes d'installation

1. **Cloner le repository**
```bash
git clone https://github.com/votre-nom/mini-mag.git
cd mini-mag
```

2. **Ouvrir le projet**
```bash
# Avec VS Code
code .

# Ou simplement ouvrir index.html dans votre navigateur
```

3. **Lancer avec Live Server (recommandé)**
- Clic droit sur `index.html`
- Sélectionner "Open with Live Server"
- Le site s'ouvre automatiquement dans votre navigateur

## 💻 Utilisation

### Navigation

- **Page d'accueil** : Affiche la grille de 9 articles
- **Articles détaillés** : Cliquez sur une carte pour lire l'article complet
- **Catégories** : Utilisez la navigation pour filtrer par thème

### Personnalisation

#### Modifier les couleurs

Dans `styles.css`, changez les variables de couleurs :

```css
/* Couleur principale */
background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);

/* Couleur d'accent */
color: #f97316;

/* Arrière-plan */
background: #f8fafc;
```

#### Ajouter un article

1. Dupliquez un fichier dans `/pages/`
2. Modifiez le contenu HTML
3. Ajoutez une carte dans `index.html` :

```html
<article class="card">
  <a href="/pages/nouvel-article.html">
    <div class="thumb">
      <img src="URL_IMAGE" alt="Description">
    </div>
    <div class="card-content">
      <div class="kicker">Catégorie</div>
      <h2 class="h2">Titre de l'article</h2>
    </div>
    <div class="meta">
      <span class="byline">Par Auteur</span>
      <time datetime="2025-11-01">1 nov. 2025</time>
    </div>
  </a>
</article>
```

## 📸 Captures d'écran

### Desktop
![Page d'accueil Desktop](screenshots/desktop.png)

### Tablette
![Version Tablette](screenshots/tablet.png)

### Mobile
![Version Mobile](screenshots/mobile.png)

*Note : Ajoutez vos propres captures d'écran dans un dossier `/screenshots/`*

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

Cette approche permet une adaptation fluide sans media queries complexes.

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
- ⚡ CSS vanilla (pas de framework lourd)

## ✅ Validation W3C

Le code a été validé avec succès :

- **HTML5** : [Valider](https://validator.w3.org/)
- **CSS3** : [Valider](https://jigsaw.w3.org/css-validator/)

Pour valider votre code :

```bash
# HTML
https://validator.w3.org/#validate_by_input

# CSS
https://jigsaw.w3.org/css-validator/#validate_by_input
```

## 📝 Cahier des charges

Ce projet répond aux contraintes suivantes :

- [x] Interface type magazine avec plusieurs articles
- [x] Navigation simulée entre pages
- [x] 6 à 9 articles sur la page d'accueil
- [x] CSS Grid pour l'agencement
- [x] Effet zoom au survol des images
- [x] Responsive design (mobile, tablette, desktop)
- [x] HTML5 et CSS3 uniquement
- [x] Fichiers HTML/CSS séparés
- [x] Validation W3C

## 🐛 Problèmes connus

- Les images Unsplash peuvent avoir un temps de chargement variable selon la connexion
- Le backdrop-filter peut avoir des problèmes de performance sur certains navigateurs anciens

## 🚧 Améliorations futures

- [ ] Ajouter un système de filtrage par catégorie (JavaScript)
- [ ] Implémenter une barre de recherche
- [ ] Créer un mode sombre (dark mode)
- [ ] Ajouter du lazy-loading pour les images
- [ ] Implémenter une pagination
- [ ] Ajouter des animations d'apparition au scroll

## 👥 Auteurs

- **Fourat Jebali** - *Développement initial* - [GitHub](https://github.com/votre-nom)
- **[Nom du binôme]** - *Contribution* - [GitHub](https://github.com/)

## 🎓 Contexte académique

Projet réalisé dans le cadre du module **Développement Web** en **FIA3** à l'**Institut Supérieur des Sciences Appliquées et de Technologie de Sousse (ISSAT Sousse)**.

**Année universitaire** : 2025/2026

## 📄 Licence

Ce projet est un projet académique libre d'utilisation à des fins éducatives.

---

## 📞 Contact

Pour toute question ou suggestion :

- 📧 Email : [votre.email@example.com]
- 💼 LinkedIn : [Votre profil LinkedIn]
- 🐦 Twitter : [@votre_compte]

---

## 🙏 Remerciements

- [Unsplash](https://unsplash.com/) pour les magnifiques images gratuites
- [MDN Web Docs](https://developer.mozilla.org/) pour la documentation
- [CSS-Tricks](https://css-tricks.com/) pour les tutoriels sur CSS Grid
- Nos professeurs pour leur accompagnement

---

⭐ **N'oubliez pas de mettre une étoile si vous aimez ce projet !** ⭐
