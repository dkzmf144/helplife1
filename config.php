<?php
$servername = "localhost"; // Geralmente 'localhost' no XAMPP
$username = "root";        // Nome de usuário padrão do XAMPP
$password = "";            // Senha padrão do XAMPP (geralmente vazia)
$dbname = "helplife";     // O nome do seu banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}else{
    print("Conexão Ok");
}
?>