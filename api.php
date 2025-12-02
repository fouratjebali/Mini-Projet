<?php

require_once 'config.php';

header('Content-Type: application/json; charset=utf-8');

$action = $_GET['action'] ?? '';

try {
    switch ($action) {
        
        case 'get_articles':
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
            echo json_encode(['success' => true, 'articles' => $articles]);
            break;

        case 'get_article':
            $slug = $_GET['slug'] ?? '';
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
            
            if ($article) {
                echo json_encode(['success' => true, 'article' => $article]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Article non trouvé']);
            }
            break;

        case 'add_like':
            $article_id = $_POST['article_id'] ?? 0;
            $ip = getClientIP();
            
            $stmt = $pdo->prepare("SELECT id FROM likes WHERE article_id = ? AND ip_address = ?");
            $stmt->execute([$article_id, $ip]);
            
            if ($stmt->fetch()) {
                echo json_encode(['success' => false, 'message' => 'Vous avez déjà liké cet article']);
            } else {
                $stmt = $pdo->prepare("INSERT INTO likes (article_id, ip_address) VALUES (?, ?)");
                $stmt->execute([$article_id, $ip]);
                
                $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM likes WHERE article_id = ?");
                $stmt->execute([$article_id]);
                $result = $stmt->fetch();
                
                echo json_encode(['success' => true, 'likes' => $result['total']]);
            }
            break;

        case 'get_likes':
            $article_id = $_GET['article_id'] ?? 0;
            $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM likes WHERE article_id = ?");
            $stmt->execute([$article_id]);
            $result = $stmt->fetch();
            echo json_encode(['success' => true, 'likes' => $result['total']]);
            break;

        case 'add_comment':
            $article_id = $_POST['article_id'] ?? 0;
            $nom = trim($_POST['nom'] ?? '');
            $commentaire = trim($_POST['commentaire'] ?? '');
            
            if (empty($nom) || empty($commentaire)) {
                echo json_encode(['success' => false, 'message' => 'Tous les champs sont requis']);
                break;
            }
            
            if (strlen($commentaire) < 3) {
                echo json_encode(['success' => false, 'message' => 'Le commentaire est trop court']);
                break;
            }
            
            $stmt = $pdo->prepare("
                INSERT INTO commentaires (article_id, nom, commentaire) 
                VALUES (?, ?, ?)
            ");
            $stmt->execute([$article_id, $nom, $commentaire]);
            
            echo json_encode([
                'success' => true, 
                'message' => 'Commentaire ajouté avec succès',
                'comment' => [
                    'id' => $pdo->lastInsertId(),
                    'nom' => $nom,
                    'commentaire' => $commentaire,
                    'date_commentaire' => date('Y-m-d H:i:s')
                ]
            ]);
            break;

        case 'get_comments':
            $article_id = $_GET['article_id'] ?? 0;
            $stmt = $pdo->prepare("
                SELECT * FROM commentaires 
                WHERE article_id = ? 
                ORDER BY date_commentaire DESC
            ");
            $stmt->execute([$article_id]);
            $comments = $stmt->fetchAll();
            echo json_encode(['success' => true, 'comments' => $comments]);
            break;

        case 'contact':
            $nom = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $message = trim($_POST['message'] ?? '');
            
            if (empty($nom) || empty($email) || empty($message)) {
                echo json_encode(['success' => false, 'message' => 'Tous les champs sont requis']);
                break;
            }
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(['success' => false, 'message' => 'Email invalide']);
                break;
            }
            
            
            echo json_encode([
                'success' => true, 
                'message' => 'Votre message a été envoyé avec succès !'
            ]);
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Action non reconnue']);
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur : ' . $e->getMessage()]);
}
?>