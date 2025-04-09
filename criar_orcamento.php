<?php
include 'db.php'; // Conexão com o banco

// Carrega categorias e produtos para os selects
$categorias = $pdo->query("SELECT * FROM categorias")->fetchAll(PDO::FETCH_ASSOC);
$produtos = $pdo->query("SELECT * FROM produtos")->fetchAll(PDO::FETCH_ASSOC);

// Ao enviar o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoria_id = $_POST['categoria_id'];
    $itens = $_POST['itens'];

    // Cria orçamento
    $stmt = $pdo->prepare("INSERT INTO orcamentos (categoria_id) VALUES (?)");
    $stmt->execute([$categoria_id]);
    $orcamento_id = $pdo->lastInsertId();

    // Adiciona itens
    $stmt_item = $pdo->prepare("INSERT INTO itens_orcamento (orcamento_id, produto_id, quantidade, valor_sugerido) VALUES (?, ?, ?, ?)");
    foreach ($itens as $item) {
        $produto_id = $item['produto_id'];
        $quantidade = $item['quantidade'];
        $valor_sugerido = !empty($item['valor_sugerido']) ? $item['valor_sugerido'] : null;
        $stmt_item->execute([$orcamento_id, $produto_id, $quantidade, $valor_sugerido]);
    }

    echo "<p>Orçamento criado com sucesso! Número: $orcamento_id</p>";
}
?>

<h2>Criar Novo Orçamento</h2>

<form method="POST">
    <label>Categoria do Produto:</label><br>
    <select name="categoria_id" required>
        <option value="">Selecione</option>
        <?php foreach ($categorias as $categoria): ?>
            <option value="<?= $categoria['id'] ?>"><?= $categoria['nome'] ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <h3>Itens do Orçamento</h3>
    <div id="itens-container">
        <div class="item">
            <select name="itens[0][produto_id]" required>
                <option value="">Produto...</option>
                <?php foreach ($produtos as $produto): ?>
                    <option value="<?= $produto['id'] ?>"><?= $produto['nome'] ?></option>
                <?php endforeach; ?>
            </select>
            <input type="number" name="itens[0][quantidade]" placeholder="Quantidade" required min="1">
            <input type="text" name="itens[0][valor_sugerido]" placeholder="Valor Sugerido (opcional)">
        </div>
    </div>

    <button type="button" onclick="adicionarItem()">Adicionar Item</button><br><br>
    <button type="submit">Criar Orçamento</button>
</form>

<script>
let index = 1;
function adicionarItem() {
    const container = document.getElementById('itens-container');
    const itemHTML = `
        <div class="item">
            <select name="itens[${index}][produto_id]" required>
                <option value="">Produto...</option>
                <?php foreach ($produtos as $produto): ?>
                    <option value="<?= $produto['id'] ?>"><?= $produto['nome'] ?></option>
                <?php endforeach; ?>
            </select>
            <input type="number" name="itens[${index}][quantidade]" placeholder="Quantidade" required min="1">
            <input type="text" name="itens[${index}][valor_sugerido]" placeholder="Valor Sugerido (opcional)">
        </div>
    `;
    container.insertAdjacentHTML('beforeend', itemHTML);
    index++;
}
</script>
