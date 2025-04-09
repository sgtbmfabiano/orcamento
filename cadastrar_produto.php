<?php
// Conectar ao banco de dados
include 'db.php';  // Supondo que você tenha um arquivo db.php para conectar ao banco

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $marca = $_POST['marca'];
    $preco_sugerido = $_POST['preco_sugerido'] ?: null;  // Se não preenchido, será NULL

    // Inserir no banco de dados
    $stmt = $pdo->prepare("INSERT INTO produtos (nome, descricao, marca, preco_sugerido) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $descricao, $marca, $preco_sugerido]);

    echo "Produto cadastrado com sucesso!";
}
?>

<!-- Formulário de Cadastro de Produto -->
<form action="cadastrar_produto.php" method="POST">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" required><br><br>

    <label for="descricao">Descrição:</label>
    <textarea name="descricao" id="descricao"></textarea><br><br>

    <label for="marca">Marca:</label>
    <input type="text" name="marca" id="marca"><br><br>

    <label for="preco_sugerido">Preço Sugerido:</label>
    <input type="text" name="preco_sugerido" id="preco_sugerido"><br><br>

    <button type="submit">Cadastrar Produto</button>
</form>
