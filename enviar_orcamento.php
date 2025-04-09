<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orcamento_id = $_POST['orcamento_id'];

    // Buscar categoria do orçamento
    $stmt = $pdo->prepare("SELECT categoria_id FROM orcamentos WHERE id = ?");
    $stmt->execute([$orcamento_id]);
    $categoria_id = $stmt->fetchColumn();

    // Buscar fornecedores da categoria
    $stmt = $pdo->prepare("SELECT * FROM fornecedores WHERE categoria_id = ?");
    $stmt->execute([$categoria_id]);
    $fornecedores = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<h2>Escolha os Fornecedores para Enviar o Orçamento Nº <?= $orcamento_id ?></h2>

<form method="POST" action="processar_envio.php">
    <input type="hidden" name="orcamento_id" value="<?= $orcamento_id ?>">

    <?php if (count($fornecedores) > 0): ?>
        <ul>
            <?php foreach ($fornecedores as $f): ?>
                <li>
                    <label>
                        <input type="checkbox" name="fornecedores[]" value="<?= $f['id'] ?>">
                        <?= $f['razao_social'] ?> (<?= $f['email'] ?>)
                    </label>
                </li>
            <?php endforeach; ?>
        </ul>
        <button type="submit">Enviar Orçamento</button>
    <?php else: ?>
        <p><strong>Nenhum fornecedor cadastrado para esta categoria.</strong></p>
    <?php endif; ?>
</form>
