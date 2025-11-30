<?php
session_start();
require_once __DIR__ . '/jwt_helper.php';

if (JWT::verify()) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $validUsername = 'admin';
    $validPassword = 'Is91396926';
    
    if ($username === $validUsername && $password === $validPassword) {

        $payload = [
            'username' => $username,
            'iat' => time(),
            'exp' => time() + (24 * 60 * 60)
        ];
        
        $token = JWT::encode($payload);

        setcookie('admin_token', $token, time() + (24 * 60 * 60), '/', '', false, true);
        
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Usuário ou senha inválidos';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin</title>
    <link href="../public/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #64268c 0%, #8b3db8 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 40px;
            width: 100%;
            max-width: 400px;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header h1 {
            color: #64268c;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
        }
        .form-control:focus {
            border-color: #64268c;
            box-shadow: 0 0 0 0.2rem rgba(100, 38, 140, 0.25);
        }
        .btn-login {
            background: #64268c;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            width: 100%;
            font-weight: bold;
            transition: background 0.3s;
        }
        .btn-login:hover {
            background: #8b3db8;
        }
        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Admin Panel</h1>
           
        </div>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="username">Usuário</label>
                <input type="text" class="form-control" id="username" name="username" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-login">Entrar</button>
        </form>
        
      
    </div>
</body>
</html>

