<?php

require_once '../config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();
        
        if ($admin && $password === $admin['password']) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            header('Location: index.php');
            exit;
        } else {
            $error = 'Identifiants incorrects';
        }
    } else {
        $error = 'Veuillez remplir tous les champs';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - Mini Mag</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 2rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }
        .login-container h1 {
            text-align: center;
            color: #0f766e;
            margin-bottom: 2rem;
        }
        .login-container .field {
            margin-bottom: 1.5rem;
        }
        .login-container label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1a2332;
        }
        .login-container input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 1rem;
        }
        .login-container input:focus {
            outline: none;
            border-color: #14b8a6;
        }
        .login-container button {
            width: 100%;
            padding: 0.875rem;
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .login-container button:hover {
            transform: translateY(-2px);
        }
        .error {
            background: #fee2e2;
            color: #dc2626;
            padding: 0.75rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            text-align: center;
        }
        .back-link {
            text-align: center;
            margin-top: 1rem;
        }
        .back-link a {
            color: #0f766e;
            text-decoration: none;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>🔐 Connexion Admin</h1>
        
        <?php if ($error): ?>
            <div class="error"><?= e($error) ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="field">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" required autofocus>
            </div>
            
            <div class="field">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Se connecter</button>
        </form>
        
        <div class="back-link">
            <a href="../index.php">← Retour au site</a>
        </div>
        
        <div style="margin-top: 2rem; padding: 1rem; background: #f0fdfa; border-radius: 8px; font-size: 0.875rem;">
            <strong>Identifiants par défaut :</strong><br>
            Username: <code>admin</code><br>
            Password: <code>admin123</code>
        </div>
    </div>
</body>
</html>