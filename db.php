<?php
$host = 'localhost'; // Host do MySQL
$username = 'root'; // Usuário do MySQL
$password = ''; // Senha do MySQL
$dbname = 'orcamentos'; // Nome do banco de dados

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}
?>
