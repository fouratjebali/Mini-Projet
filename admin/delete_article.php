<?php
require_once '../config.php';

header('Content-Type: application/json');

if (!isLoggedIn()) {
    echo json_encode(['success' => false, 'message' => 'Non autorisé']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? 0;
    
    try {
        $stmt = $pdo->prepare("DELETE FROM articles WHERE id = ?");
        $stmt->execute([$id]);
        
        echo json_encode(['success' => true, 'message' => 'Article supprimé']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
}
?>