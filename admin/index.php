<?php

require_once '../config.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$stmt = $pdo->query("
    SELECT a.*, 
           COUNT(DISTINCT l.id) as nb_likes,
           COUNT(DISTINCT c.id) as nb_comments
    FROM articles a
    LEFT JOIN likes l ON a.id = l.article_id
    LEFT JOIN commentaires c ON a.id = c.article_id
    GROUP BY a.id
    ORDER BY a.date_publication DESC
");
$articles = $stmt->fetchAll();

$stats = [
    'total_articles' => $pdo->query("SELECT COUNT(*) FROM articles")->fetchColumn(),
    'total_likes' => $pdo->query("SELECT COUNT(*) FROM likes")->fetchColumn(),
    'total_comments' => $pdo->query("SELECT COUNT(*) FROM commentaires")->fetchColumn()
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Mini Mag</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        .admin-header {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        .admin-header h1 {
            margin: 0;
            font-size: 1.8rem;
        }
        .admin-header .user-info {
            margin-top: 0.5rem;
            font-size: 0.9rem;
            opacity: 0.9;
        }
        .admin-nav {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }
        .admin-nav a, .admin-nav button {
            padding: 0.5rem 1rem;
            background: rgba(255,255,255,0.2);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }
        .admin-nav a:hover, .admin-nav button:hover {
            background: rgba(255,255,255,0.3);
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .stat-card h3 {
            margin: 0 0 0.5rem 0;
            font-size: 2rem;
            color: #14b8a6;
        }
        .stat-card p {
            margin: 0;
            color: #64748b;
        }
        .articles-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .articles-table table {
            width: 100%;
            border-collapse: collapse;
        }
        .articles-table th {
            background: #f1f5f9;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #1a2332;
        }
        .articles-table td {
            padding: 1rem;
            border-top: 1px solid #e0e7ef;
        }
        .articles-table tr:hover {
            background: #f8fafc;
        }
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.875rem;
            display: inline-block;
            cursor: pointer;
            border: none;
        }
        .btn-primary {
            background: #14b8a6;
            color: white;
        }
        .btn-secondary {
            background: #f97316;
            color: white;
        }
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        .btn:hover {
            opacity: 0.9;
        }
        .actions {
            display: flex;
            gap: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <div class="container">
            <h1>📊 Tableau de bord</h1>
            <div class="user-info">
                Connecté en tant que <strong><?= e($_SESSION['admin_username']) ?></strong>
            </div>
            <div class="admin-nav">
                <a href="../index.php" target="_blank">Voir le site</a>
                <a href="add_article.php">+ Nouvel article</a>
                <button onclick="if(confirm('Voulez-vous vraiment vous déconnecter ?')) location.href='logout.php'">Déconnexion</button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="stats">
            <div class="stat-card">
                <h3><?= $stats['total_articles'] ?></h3>
                <p>Articles publiés</p>
            </div>
            <div class="stat-card">
                <h3><?= $stats['total_likes'] ?></h3>
                <p>Likes au total</p>
            </div>
            <div class="stat-card">
                <h3><?= $stats['total_comments'] ?></h3>
                <p>Commentaires</p>
            </div>
        </div>

        <div class="articles-table">
            <table>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Auteur</th>
                        <th>Date</th>
                        <th>👍 Likes</th>
                        <th>💬 Comm.</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><strong><?= e($article['titre']) ?></strong></td>
                        <td><span class="badge"><?= e($article['kicker']) ?></span></td>
                        <td><?= e($article['auteur']) ?></td>
                        <td><?= date('d/m/Y', strtotime($article['date_publication'])) ?></td>
                        <td><?= $article['nb_likes'] ?></td>
                        <td><?= $article['nb_comments'] ?></td>
                        <td>
                            <div class="actions">
                                <a href="../article.php?slug=<?= e($article['slug']) ?>" class="btn btn-primary" target="_blank">Voir</a>
                                <a href="edit_article.php?id=<?= $article['id'] ?>" class="btn btn-secondary">Modifier</a>
                                <button class="btn btn-danger" onclick="deleteArticle(<?= $article['id'] ?>)">Supprimer</button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    
                    <?php if (empty($articles)): ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 2rem; color: #64748b;">
                            Aucun article publié. <a href="add_article.php">Créer le premier article</a>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function deleteArticle(id) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cet article ?')) {
                return;
            }
            
            fetch('delete_article.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'id=' + id
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Article supprimé avec succès');
                    location.reload();
                } else {
                    alert('Erreur : ' + data.message);
                }
            })
            .catch(error => {
                alert('Erreur lors de la suppression');
            });
        }
    </script>
</body>
</html>