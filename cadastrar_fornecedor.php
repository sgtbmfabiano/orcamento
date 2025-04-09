<?php
// Conectar ao banco de dados
include 'db.php';  // Supondo que você tenha um arquivo db.php para conectar ao banco

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $razao_social = $_POST['razao_social'];
    $nome_fantasia = $_POST['nome_fantasia'];
    $cnpj = $_POST['cnpj'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $whatsapp = $_POST['whatsapp'];
    $inscricao_estadual = $_POST['inscricao_estadual'];
    $inscricao_municipal = $_POST['inscricao_municipal'];
    $email = $_POST['email'];

    // Inserir no banco de dados
    $stmt = $pdo->prepare("INSERT INTO fornecedores (razao_social, nome_fantasia, cnpj, endereco, telefone, whatsapp, inscricao_estadual, inscricao_municipal, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$razao_social, $nome_fantasia, $cnpj, $endereco, $telefone, $whatsapp, $inscricao_estadual, $inscricao_municipal, $email]);

    echo "Fornecedor cadastrado com sucesso!";
}
?>

<!-- Formulário de Cadastro de Fornecedor -->
<form action="cadastrar_fornecedor.php" method="POST">
    <label for="razao_social">Razão Social:</label>
    <input type="text" name="razao_social" id="razao_social" required><br><br>

    <label for="nome_fantasia">Nome Fantasia:</label>
    <input type="text" name="nome_fantasia" id="nome_fantasia" required><br><br>

    <label for="cnpj">CNPJ:</label>
    <input type="text" name="cnpj" id="cnpj" required><br><br>

    <label for="endereco">Endereço:</label>
    <textarea name="endereco" id="endereco"></textarea><br><br>

    <label for="telefone">Telefone:</label>
    <input type="text" name="telefone" id="telefone"><br><br>

    <label for="whatsapp">WhatsApp:</label>
    <input type="text" name="whatsapp" id="whatsapp"><br><br>

    <label for="inscricao_estadual">Inscrição Estadual:</label>
    <input type="text" name="inscricao_estadual" id="inscricao_estadual"><br><br>

    <label for="inscricao_municipal">Inscrição Municipal:</label>
    <input type="text" name="inscricao_municipal" id="inscricao_municipal"><br><br>

    <label for="email">E-mail:</label>
    <input type="email" name="email" id="email" required><br><br>

    <button type="submit">Cadastrar Fornecedor</button>
</form>
