<?php

require_once '../config.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = trim($_POST['titre'] ?? '');
    $kicker = trim($_POST['kicker'] ?? '');
    $lead = trim($_POST['lead'] ?? '');
    $contenu = trim($_POST['contenu'] ?? '');
    $image_url = trim($_POST['image_url'] ?? '');
    $auteur = trim($_POST['auteur'] ?? '');
    
    if (empty($titre) || empty($kicker) || empty($lead) || empty($contenu) || empty($image_url) || empty($auteur)) {
        $error = 'Tous les champs sont requis';
    } else {
        $slug = generateSlug($titre);
        
        $stmt = $pdo->prepare("SELECT id FROM articles WHERE slug = ?");
        $stmt->execute([$slug]);
        if ($stmt->fetch()) {
            $slug .= '-' . time();
        }
        
        try {
            $stmt = $pdo->prepare("
                INSERT INTO articles (titre, kicker, lead, contenu, image_url, auteur, slug) 
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([$titre, $kicker, $lead, $contenu, $image_url, $auteur, $slug]);
            $success = 'Article créé avec succès !';
            
            header("refresh:2;url=index.php");
        } catch (PDOException $e) {
            $error = 'Erreur lors de la création : ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel Article - Admin</title>
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
        }
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1a2332;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 1rem;
            font-family: inherit;
        }
        .form-group textarea {
            min-height: 200px;
            resize: vertical;
        }
        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        .btn {
            padding: 0.875rem 1.5rem;
            border-radius: 8px;
            border: none;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
        }
        .btn-secondary {
            background: #f1f5f9;
            color: #1a2332;
        }
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }
        .alert-error {
            background: #fee2e2;
            color: #dc2626;
        }
        .alert-success {
            background: #d1fae5;
            color: #047857;
        }
        .help-text {
            font-size: 0.875rem;
            color: #64748b;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <div class="container">
            <h1>✏️ Nouvel Article</h1>
        </div>
    </div>

    <div class="container">
        <div class="form-container">
            <?php if ($error): ?>
                <div class="alert alert-error"><?= e($error) ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <?= e($success) ?><br>
                    <small>Redirection en cours...</small>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="titre">Titre de l'article *</label>
                    <input type="text" id="titre" name="titre" required 
                           value="<?= e($_POST['titre'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="kicker">Catégorie *</label>
                    <select id="kicker" name="kicker" required>
                        <option value="">-- Sélectionner --</option>
                        <option value="Culture" <?= ($_POST['kicker'] ?? '') === 'Culture' ? 'selected' : '' ?>>Culture</option>
                        <option value="Tech" <?= ($_POST['kicker'] ?? '') === 'Tech' ? 'selected' : '' ?>>Tech</option>
                        <option value="Voyage" <?= ($_POST['kicker'] ?? '') === 'Voyage' ? 'selected' : '' ?>>Voyage</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="lead">Introduction *</label>
                    <textarea id="lead" name="lead" rows="3" required><?= e($_POST['lead'] ?? '') ?></textarea>
                    <div class="help-text">Résumé court qui apparaît dans la liste des articles</div>
                </div>

                <div class="form-group">
                    <label for="contenu">Contenu HTML *</label>
                    <textarea id="contenu" name="contenu" required><?= e($_POST['contenu'] ?? '') ?></textarea>
                    <div class="help-text">Vous pouvez utiliser des balises HTML : &lt;h2&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;li&gt;</div>
                </div>

                <div class="form-group">
                    <label for="image_url">URL de l'image *</label>
                    <input type="url" id="image_url" name="image_url" required
                           placeholder="https://images.unsplash.com/..."
                           value="<?= e($_POST['image_url'] ?? '') ?>">
                    <div class="help-text">Lien complet vers une image (Unsplash recommandé)</div>
                </div>

                <div class="form-group">
                    <label for="auteur">Auteur *</label>
                    <input type="text" id="auteur" name="auteur" required
                           value="<?= e($_POST['auteur'] ?? '') ?>">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Publier l'article</button>
                    <a href="index.php" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>