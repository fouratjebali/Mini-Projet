<?php

require_once 'config.php';

$stmt = $pdo->query("
    SELECT a.*, 
           COUNT(DISTINCT l.id) as nb_likes
    FROM articles a
    LEFT JOIN likes l ON a.id = l.article_id
    GROUP BY a.id
    ORDER BY a.date_publication DESC
    LIMIT 9
");
$articles = $stmt->fetchAll();
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mini Mag</title>
  <meta name="description" content="Mini magazine en ligne : articles, navigation, responsive, HTML5/CSS3/PHP.">
  <link rel="preconnect" href="https://images.unsplash.com" crossorigin>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <a href="#contenu" class="visually-hidden">Aller au contenu principal</a>

  <header class="header">
    <div class="header-inner">
      <div class="brand"><a href="index.php" aria-current="page">Mini Mag</a></div>
      <nav class="nav" aria-label="Navigation principale">
        <a href="index.php" aria-current="page">Accueil</a>
        <a href="admin/login.php">Admin</a>
      </nav>
    </div>
  </header>

  <main id="contenu" class="container">
    <h1 class="visually-hidden">Une sélection d'articles</h1>
    <section aria-label="Grille d'articles">
      <div class="grid">
        <?php foreach ($articles as $article): ?>
        <article class="card">
          <a href="article.php?slug=<?= e($article['slug']) ?>" aria-label="Lire l'article : <?= e($article['titre']) ?>">
            <div class="thumb">
              <img src="<?= e($article['image_url']) ?>" alt="<?= e($article['titre']) ?>">
            </div>
            <div class="card-content">
              <div class="kicker"><?= e($article['kicker']) ?></div>
              <h2 class="h2"><?= e($article['titre']) ?></h2>
            </div>
            <div class="meta">
              <span class="byline">Par <?= e($article['auteur']) ?></span>
              <time datetime="<?= $article['date_publication'] ?>">
                <?= date('d M Y', strtotime($article['date_publication'])) ?>
              </time>
            </div>
          </a>
        </article>
        <?php endforeach; ?>
        
        <?php if (empty($articles)): ?>
        <div style="grid-column: 1/-1; text-align: center; padding: 3rem;">
          <p style="font-size: 1.2rem; color: #64748b;">Aucun article disponible pour le moment.</p>
          <a href="admin/login.php" style="color: #14b8a6; text-decoration: underline;">
            Connectez-vous pour en publier
          </a>
        </div>
        <?php endif; ?>
      </div>
    </section>

    <section aria-label="Carrousel">
      <div class="carousel">
        <h2>Les plus célèbres</h2>
        <button class="prev">←</button>
        <div class="carousel-track">
          <img src="https://images.unsplash.com/photo-1505765050516-f72dcac9c60e?w=1200&auto=format&fit=crop&q=80" alt="Ville moderne">
          <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=1200&auto=format&fit=crop&q=80" alt="Montagne">
          <img src="https://images.unsplash.com/photo-1497032628192-86f99bcd76bc?w=1200&auto=format&fit=crop&q=80" alt="Street art">
          <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1200&auto=format&fit=crop&q=80" alt="Plage tropicale">
        </div>
        <button class="next">→</button>
      </div>
    </section>

    <section class="testimonials">
      <h2>Témoignages</h2>
      <div class="testimonial">"Super mini-mag ! Très fluide." — Jade</div>
      <div class="testimonial">"Design professionnel, bravo." — Marc</div>
      <div class="testimonial">"Lecture agréable et rapide." — Sana</div>
    </section>

    <section class="contact">
      <h2>Contactez-nous</h2>
      <form id="contactForm">
        <div class="field">
          <label for="name">Nom</label>
          <input type="text" name="name" id="name" required>
        </div>

        <div class="field">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" required>
        </div>

        <div class="field">
          <label for="message">Message</label>
          <textarea name="message" id="message" rows="4" required></textarea>
        </div>

        <button type="submit">Envoyer</button>
      </form>
      <div id="contactMessage" style="margin-top: 1rem;"></div>
    </section>
  </main>

  <footer class="footer">
    <div class="footer-inner">
      © 2025 MiniMAG – All Rights Reserved. Fourat Jebali :3
    </div>
  </footer>

  <script>
    // Gestion du carrousel
    const carousel = document.querySelector('.carousel');
    if (carousel) {
      const track = carousel.querySelector('.carousel-track');
      const next = carousel.querySelector('.next');
      const prev = carousel.querySelector('.prev');
      let index = 0;
      const slides = track.children.length;
      const visible = 3;

      function update() {
        const width = track.children[0].offsetWidth + 16;
        track.style.transform = `translateX(${-index * width}px)`;
      }

      next.addEventListener('click', () => {
        if (index < slides - visible) index++;
        update();
      });

      prev.addEventListener('click', () => {
        if (index > 0) index--;
        update();
      });

      window.addEventListener('resize', update);
    }

    // Animation des témoignages
    const testimonials = document.querySelectorAll('.testimonial');
    if (testimonials.length) {
      let index = 0;
      setInterval(() => {
        testimonials.forEach((el, i) => {
          el.style.opacity = i === index ? 1 : 0;
        });
        index = (index + 1) % testimonials.length;
      }, 5000);
    }

    // Gestion du menu sticky
    let last = 0;
    const header = document.querySelector('.header');
    window.addEventListener('scroll', () => {
      const current = window.scrollY;
      if (current > last && current > 80) {
        header.style.transform = 'translateY(-100%)';
      } else {
        header.style.transform = 'translateY(0)';
      }
      last = current;
    });

    // Formulaire de contact avec AJAX
    document.getElementById('contactForm').addEventListener('submit', async (e) => {
      e.preventDefault();
      
      const formData = new FormData(e.target);
      const messageDiv = document.getElementById('contactMessage');
      
      try {
        const response = await fetch('api.php?action=contact', {
          method: 'POST',
          body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
          messageDiv.innerHTML = '<div style="padding: 1rem; background: #d1fae5; color: #047857; border-radius: 8px;">' + data.message + '</div>';
          e.target.reset();
        } else {
          messageDiv.innerHTML = '<div style="padding: 1rem; background: #fee2e2; color: #dc2626; border-radius: 8px;">' + data.message + '</div>';
        }
      } catch (error) {
        messageDiv.innerHTML = '<div style="padding: 1rem; background: #fee2e2; color: #dc2626; border-radius: 8px;">Erreur lors de l\'envoi</div>';
      }
    });
  </script>
</body>
</html>