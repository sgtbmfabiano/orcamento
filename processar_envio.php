<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $orcamento_id = $_POST['orcamento_id'];
    $fornecedoresSelecionados = $_POST['fornecedores']; // array com IDs dos fornecedores

    $notificados = 0;  // contador de fornecedores notificados

    foreach ($fornecedoresSelecionados as $fornecedor_id) {
        // Busca os dados do fornecedor
        $stmt = $pdo->prepare("SELECT * FROM fornecedores WHERE id = ?");
        $stmt->execute([$fornecedor_id]);
        $fornecedor = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fornecedor) {
            // Gera o link para preenchimento do orçamento
            // Acrescente ao link o seu domínio ou endereço correto
            $link = "http://seusite.com/preencher_orcamento.php?orcamento_id={$orcamento_id}&fornecedor_id={$fornecedor_id}";

            // Conteúdo do e-mail
            $subject = "Novo Orçamento Disponível - Orçamento Nº {$orcamento_id}";
            $message = "Prezado(a) " . $fornecedor['razao_social'] . ",\n\n"
                . "Você recebeu um novo orçamento para preencher.\n"
                . "Por favor, acesse o link abaixo para preencher e enviar sua proposta:\n"
                . "{$link}\n\n"
                . "Atenciosamente,\nSua Empresa";
            
            // Cabeçalhos do e-mail - ajuste conforme sua configuração
            $headers = "From: seuemail@seudominio.com\r\n";
            
            // Envia o e-mail
            if(mail($fornecedor['email'], $subject, $message, $headers)) {
                $notificados++;
            }
        }
    }

    echo "<p>Orçamento Nº {$orcamento_id} enviado para {$notificados} fornecedor(es)!</p>";
    echo "<a href='listar_orcamentos.php'>Voltar para a lista de Orçamentos</a>";
}
?>
