<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
        $nome  = $_POST['nome'];
        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        // Verifica se já existe email
        $check = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            echo "⚠️ Email já cadastrado!";
        } else {
            $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nome, $email, $senha);

            if ($stmt->execute()) {
                echo "✅ Usuário cadastrado com sucesso!";
            } else {
                echo "Erro ao cadastrar: " . $conn->error;
            }
        }

        $check->close();
    } else {
        echo "⚠️ Preencha todos os campos!";
    }
}
?>
