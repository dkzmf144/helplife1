esso!"<?php
require_once "config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['email']) && !empty($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $stmt = $conn->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $nome, $hash);
            $stmt->fetch();

            if (password_verify($senha, $hash)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['user_nome'] = $nome;
                echo "✅ Login realizado com sucesso! Bem-vindo, $nome";
            } else {
                echo "❌ Senha incorreta!";
            }
        } else {
            echo "❌ Email não encontrado!";
        }

        $stmt->close();
    } else {
        echo "⚠️ Preencha todos os campos!";
    }
}
?>

