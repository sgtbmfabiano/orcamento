<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Estoque</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <h1>Controle de Estoque</h1>

    <!-- Formulário para adicionar/editar itens -->
    <form id="itemForm">
      <label for="nome">Nome do Item:</label>
      <input type="text" id="nome" required>

      <label for="quantidade">Quantidade:</label>
      <input type="number" id="quantidade" required>

      <label for="classe">Classe:</label>
      <input type="text" id="classe" required>

      <label for="origem">Origem:</label>
      <input type="text" id="origem" required>

      <label for="data_receb">Data de Recebimento:</label>
      <input type="date" id="data_receb" required>

      <label for="observacoes">Observações:</label>
      <textarea id="observacoes"></textarea>

      <button type="submit">Adicionar Item</button>
    </form>

    <!-- Tabela para exibir os itens -->
    <h2>Itens no Estoque</h2>
    <table id="estoqueTable">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Quantidade</th>
          <th>Classe</th>
          <th>Origem</th>
          <th>Data de Recebimento</th>
          <th>Observações</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <!-- Itens serão adicionados aqui dinamicamente -->
      </tbody>
    </table>
  </div>

  <div id="formRetirada" class="modal">
    <div class="modal-content">
      <span class="fechar">&times;</span>
      <h2>Registrar Retirada</h2>
      <form id="retiradaForm">
        <p><strong>Item:</strong> <span id="nomeItemRetirada"></span></p>
        <input type="hidden" id="itemRetirada" name="item_id">
  
        <label for="quantidadeRetirada">Quantidade:</label>
        <input type="number" id="quantidadeRetirada" required>
  
        <label for="dataRetirada">Data de Retirada:</label>
        <input type="date" id="dataRetirada" required>
  
        <label for="observacoesRetirada">Observações:</label>
        <textarea id="observacoesRetirada"></textarea>
  
        <button type="submit">Cautelar</button>
      </form>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>