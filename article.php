<?php

require_once 'config.php';

$slug = $_GET['slug'] ?? '';

if (empty($slug)) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("
    SELECT a.*, 
           COUNT(DISTINCT l.id) as nb_likes
    FROM articles a
    LEFT JOIN likes l ON a.id = l.article_id
    WHERE a.slug = ?
    GROUP BY a.id
");
$stmt->execute([$slug]);
$article = $stmt->fetch();

if (!$article) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("
    SELECT * FROM commentaires 
    WHERE article_id = ? 
    ORDER BY date_commentaire DESC
");
$stmt->execute([$article['id']]);
$commentaires = $stmt->fetchAll();
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($article['titre']) ?> – Mini Magazine</title>
  <meta name="description" content="<?= e($article['lead']) ?>">
  <link rel="preconnect" href="https://images.unsplash.com" crossorigin>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <a href="#contenu" class="visually-hidden">Aller au contenu principal</a>
  
  <header class="header">
    <div class="header-inner">
      <div class="brand"><a href="index.php">Mini Mag</a></div>
      <nav class="nav" aria-label="Navigation principale">
        <a href="index.php">Accueil</a>
        <a href="admin/login.php">Admin</a>
      </nav>
    </div>
  </header>

  <main id="contenu" class="article">
    <header>
      <div class="kicker"><?= e($article['kicker']) ?></div>
      <h1><?= e($article['titre']) ?></h1>
      <p class="lead"><?= e($article['lead']) ?></p>
      <p>
        <span class="byline">Par <?= e($article['auteur']) ?></span> · 
        <time datetime="<?= $article['date_publication'] ?>">
          <?= date('d M Y', strtotime($article['date_publication'])) ?>
        </time>
      </p>
    </header>

    <figure class="cover">
      <img src="<?= e($article['image_url']) ?>" alt="<?= e($article['titre']) ?>">
    </figure>

    <article class="prose">
      <?= $article['contenu'] ?>
      <p><a href="index.php">← Retour à l'accueil</a></p>
    </article>

    <section class="interactions">
      <button class="like-btn" id="likeBtn" data-article-id="<?= $article['id'] ?>">
        ❤️ Like <span class="like-count"><?= $article['nb_likes'] ?></span>
      </button>

      <h3>Commentaires (<?= count($commentaires) ?>)</h3>
      
      <form id="commentForm" style="margin-bottom: 2rem;">
        <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
          <input type="text" name="nom" placeholder="Votre nom" required 
                 style="flex: 1; min-width: 150px; padding: 0.5rem; border: 1px solid #cbd5e1; border-radius: 8px;">
          <input type="text" name="commentaire" placeholder="Votre commentaire" required 
                 style="flex: 2; min-width: 200px; padding: 0.5rem; border: 1px solid #cbd5e1; border-radius: 8px;">
          <button type="submit" style="padding: 0.5rem 1rem; background: #0f766e; color: white; border: none; border-radius: 8px; cursor: pointer;">
            Envoyer
          </button>
        </div>
      </form>

      <div id="commentsList">
        <?php foreach ($commentaires as $comment): ?>
        <div class="comment" style="padding: 1rem; background: #f8fafc; border-left: 3px solid #14b8a6; margin-bottom: 0.75rem; border-radius: 4px;">
          <strong style="color: #0f766e;"><?= e($comment['nom']) ?></strong>
          <span style="color: #64748b; font-size: 0.875rem; margin-left: 0.5rem;">
            <?= date('d/m/Y H:i', strtotime($comment['date_commentaire'])) ?>
          </span>
          <p style="margin: 0.5rem 0 0 0; color: #1e293b;"><?= e($comment['commentaire']) ?></p>
        </div>
        <?php endforeach; ?>
        
        <?php if (empty($commentaires)): ?>
        <p style="color: #64748b; text-align: center; padding: 2rem;">
          Aucun commentaire pour le moment. Soyez le premier à commenter !
        </p>
        <?php endif; ?>
      </div>
    </section>
  </main>

  <footer class="footer">
    <div class="footer-inner">
      © 2025 MiniMAG – All Rights Reserved. Fourat Jebali :3
    </div>
  </footer>

  <script>
    const articleId = <?= $article['id'] ?>;

    document.getElementById('likeBtn').addEventListener('click', async function() {
      const btn = this;
      const countSpan = btn.querySelector('.like-count');
      
      try {
        const formData = new FormData();
        formData.append('article_id', articleId);
        
        const response = await fetch('api.php?action=add_like', {
          method: 'POST',
          body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
          countSpan.textContent = data.likes;
          btn.style.background = '#d1fae5';
          btn.style.borderColor = '#14b8a6';
          setTimeout(() => {
            btn.style.background = '';
            btn.style.borderColor = '';
          }, 1000);
        } else {
          alert(data.message);
        }
      } catch (error) {
        alert('Erreur lors de l\'ajout du like');
      }
    });

    document.getElementById('commentForm').addEventListener('submit', async function(e) {
      e.preventDefault();
      
      const formData = new FormData(this);
      const commentsList = document.getElementById('commentsList');
      
      try {
        const response = await fetch('api.php?action=add_comment', {
          method: 'POST',
          body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
          const commentHTML = `
            <div class="comment" style="padding: 1rem; background: #f8fafc; border-left: 3px solid #14b8a6; margin-bottom: 0.75rem; border-radius: 4px;">
              <strong style="color: #0f766e;">${escapeHtml(data.comment.nom)}</strong>
              <span style="color: #64748b; font-size: 0.875rem; margin-left: 0.5rem;">
                À l'instant
              </span>
              <p style="margin: 0.5rem 0 0 0; color: #1e293b;">${escapeHtml(data.comment.commentaire)}</p>
            </div>
          `;
          
          const noComments = commentsList.querySelector('p');
          if (noComments && noComments.textContent.includes('Aucun commentaire')) {
            noComments.remove();
          }
          
          commentsList.insertAdjacentHTML('afterbegin', commentHTML);
          this.reset();
          
          const h3 = document.querySelector('.interactions h3');
          const currentCount = commentsList.querySelectorAll('.comment').length;
          h3.textContent = `Commentaires (${currentCount})`;
        } else {
          alert(data.message);
        }
      } catch (error) {
        alert('Erreur lors de l\'ajout du commentaire');
      }
    });

    function escapeHtml(text) {
      const div = document.createElement('div');
      div.textContent = text;
      return div.innerHTML;
    }

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
  </script>
</body>
</html>