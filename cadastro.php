<?php
// Inclui o arquivo de conexão com o banco de dados
include 'config.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha

    // Prepara e executa a query para inserir no banco de dados
    $stmt = $conn->prepare("INSERT INTO users (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senha);

    if ($stmt->execute()) {
        echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar. Tente novamente.');</script>";
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
    <title>Cadastro</title>
    <link rel="stylesheet" href="csscopy/styles.css">

    <style>
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }
        .cadastro-form {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 350px;
        }
        .cadastro-form h2 {
            margin-bottom: 1rem;
            text-align: center;
        }
        .cadastro-form input {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .cadastro-form button {
            width: 100%;
            padding: 0.75rem;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }
        .cadastro-form button:hover {
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
        <form class="cadastro-form" method="POST" action="cadastro.php">
            <h2>Crie sua conta</h2>
            <input type="text" name="nome" placeholder="Nome Completo" required>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Cadastrar</button>
        </form>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2025 Minha Loja de E-commerce. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>