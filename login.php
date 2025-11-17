<?php
// Inicia a sessão para armazenar informações do usuário
session_start();
// Inclui o arquivo de conexão
include 'config.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Prepara e executa a query para buscar o usuário
    $stmt = $conn->prepare("SELECT id, nome, senha FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    print_r($result);

    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Verifica se a senha está correta
        if (password_verify($senha, $user['senha'])) {
            // Se a senha estiver correta, armazena o nome e ID na sessão
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nome'];
            echo "<script>alert('Login realizado com sucesso!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('E-mail ou senha incorretos.');</script>";
        }
    } else {
        echo "<script>alert('E-mail ou senha incorretos.');</script>";
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }
        .login-form {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 350px;
        }
        .login-form h2 {
            margin-bottom: 1rem;
            text-align: center;
        }
        .login-form input {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-form button {
            width: 100%;
            padding: 0.75rem;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }
        .login-form button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <a href="index.php" class="logo">Minha Loja</a>
            <nav>
                <ul>
                    <li><a href="index.php">Início</a></li>
                    <li><a href="#">Produtos</a></li>
                    <li><a href="#">Categorias</a></li>
                    <li><a href="#">Contato</a></li>
                    <li><a href="login.php" class="btn-login">Login</a></li>
                    <li><a href="cadastro.php" class="btn-cadastro">Cadastro</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="form-container">
        <form class="login-form" method="POST" action="login.php">
            <h2>Acesse sua conta</h2>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2025 Minha Loja de E-commerce. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>