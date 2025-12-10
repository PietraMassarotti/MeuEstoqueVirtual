<?php

use App\Models\MetodoPagamento\MetodoPagamentoDAO;
use App\Models\Parcelamento\ParcelamentoDAO;

session_start();

if (isset($_SESSION['mensagem'])) {
    echo "<div class='message error'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']);
}
// O $id já vem do controller via extract($data)
if (!isset($id) || !$id) {
    header("Location: /MeuEstoqueVirtual/public/parcelamento");
    exit();
}

$parcelamentoDao = new ParcelamentoDAO();
$parcelamento = $parcelamentoDao->findById($id);

if (!$parcelamento) {
    echo "Parcelamento não encontrado.";
    exit();
}

$metodoPagamentoDao = new MetodoPagamentoDAO();
$metodoPagamento = $metodoPagamentoDao->showMetodoPagamento();

$title = 'Parcelamento - Editar';
$page = 'parcelamento/editar';
$basePath = '/MeuEstoqueVirtual/public';

// Garantir que o valor seja exibido corretamente
$taxaJuros = $parcelamento['taxa_juros'] ?? '';
?>

<div class="all">
    <div class="body">
        <div class="form-container">
            <h1>Editar Parcelamento</h1>

            <form action="<?= $basePath . '/parcelamento/salvar' ?>" method="POST">
                <input type="hidden" name="id" value="<?= $parcelamento['id'] ?>">

                <label>Quantidade:</label>
                <input type="number" name="quantidade" value="<?= $parcelamento['quantidade'] ?>" required>

                <label>Taxa de Juros:</label>
                <input type="text" name="taxa_juros" value="<?= $taxaJuros?>" required>

                <label>Método de Pagamento:</label>
                <select name="metodos_pagamento_id" id="metodos_pagamento_id" class="form-select" required>
                    <?php foreach ($metodoPagamento as $row): ?>
                        <option value="<?= $row['id'] ?>"
                            <?= ($parcelamento['metodos_pagamento_id'] == $row['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($row['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <div class="form-actions">
                    <button type="submit">Salvar Alterações</button>
                </div>
            </form>

            <form action="<?= $basePath . '/parcelamento' ?>" method="GET">
                <div class="form-actions">
                    <button type="submit">Voltar</button>
                </div>
            </form>
        </div>
    </div>
</div>