<?php

use App\Models\MetodoPagamento\MetodoPagamentoDAO;

session_start();

if (isset($_SESSION['mensagem'])) {
    echo "<div class='message error'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']);
}

$metodoPagamentoDao = new MetodoPagamentoDAO();
$metodoPagamento = $metodoPagamentoDao->showMetodoPagamento();

$title = 'parcelamento - Adicionar';
$page = 'parcelamento/criar';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="all">
    <div class="body">
        <div class="form-container">
            <h1>Adicionar Parcelamento</h1>

            <form action="<?= $basePath . '/parcelamento/criar' ?>" method="POST">
                <label>Quantidade:</label>
                <input type="number" id="quantidade" name="quantidade" required>

                <label>Taxa de Juros:</label>
                <input type="text" name="taxa_juros" required>

                <label>Método de Pagamento:</label>
                <select name="metodos_pagamento_id" id="metodos_pagamento_id" class="form-select">
                    <?php foreach ($metodoPagamento as $row): ?>
                        <option value="<?php echo htmlspecialchars($row['id']); ?>">
                            <?php echo htmlspecialchars($row['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <div class="form-actions">
                    <button type="submit">Adicionar</button>
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