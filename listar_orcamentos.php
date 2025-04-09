<?php
include 'db.php';

// Buscar orçamentos com nome da categoria
$sql = "SELECT o.id, o.data_criacao, o.status, c.nome AS categoria
        FROM orcamentos o
        JOIN categorias c ON o.categoria_id = c.id
        ORDER BY o.data_criacao DESC";
$orcamentos = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

// Buscar fornecedores por categoria (em AJAX ou form separado)
function getFornecedoresPorCategoria($pdo, $categoria_id) {
    $stmt = $pdo->prepare("SELECT * FROM fornecedores WHERE categoria_id = ?");
    $stmt->execute([$categoria_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<h2>Lista de Orçamentos Criados</h2>

<table border="1" cellpadding="6">
    <tr>
        <th>Nº Orçamento</th>
        <th>Data de Criação</th>
        <th>Categoria</th>
        <th>Status</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($orcamentos as $orcamento): ?>
        <tr>
            <td><?= $orcamento['id'] ?></td>
            <td><?= date('d/m/Y H:i', strtotime($orcamento['data_criacao'])) ?></td>
            <td><?= $orcamento['categoria'] ?></td>
            <td><?= ucfirst($orcamento['status']) ?></td>
            <td>
                <form method="POST" action="enviar_orcamento.php" style="display:inline;">
                    <input type="hidden" name="orcamento_id" value="<?= $orcamento['id'] ?>">
                    <input type="hidden" name="categoria_id" value="<?= $orcamento['categoria_id'] ?? '' ?>">
                    <button type="submit">Enviar Orçamento</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
