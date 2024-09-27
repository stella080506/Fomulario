<?php
$servername = "localhost"; // Geralmente localhost para XAMPP
$username = "root"; // Usuário padrão do MySQL no XAMPP
$password = "cimatec"; // Senha padrão do MySQL no XAMPP, geralmente em branco
$dbname = "bancoPHP"; // Nome do banco de dados criado

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
