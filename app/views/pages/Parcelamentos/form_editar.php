<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../Login/index.php");
    exit();
}

use App\Models\MetodoPagamento\MetodoPagamentoDAO;
use App\Models\Parcelamento\ParcelamentoDAO;

$parcelamentoDao = new ParcelamentoDAO();
$parcelamento = $parcelamentoDao->findById($id);

if (!$parcelamento) {
    echo "parcelamento não encontrada.";
    exit();
}

$admin = $_SESSION['admin']['id'];
$metodoPagamentoDao = new MetodoPagamentoDAO();
$metodoPagamento = $metodoPagamentoDao->showMetodoPagamento($admin);

$title = 'Categoria - Editar ';
$page = 'categoria/editar';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="all">
    <div class="body">
        <div class="form-container">
            <h1>Editar Parcelamento</h1>
            
            <form action="<?= $basePath . '/parcelamento/salvar' ?>" method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($parcelamento['id']) ?>">
                
                <label>Quantidade:</label>
                <input type="number" name="quantidade" value="<?= htmlspecialchars($parcelamento['quantidade']) ?>" required>

                <label>Taxa de Juros:</label>
                <input type="text" name="taxa_juros" value="<?= htmlspecialchars($parcelamento['taxa_juros']) ?>">

                <label>Método de Pagamento:</label>
                <select name="metodos_pagamento_id" id="metodos_pagamento_id" class="form-select">
                    <?php foreach ($metodoPagamento as $row): ?>
                        <option value="<?php echo htmlspecialchars($row['id']); ?>"
                            <?= (isset($parcelamento['metodos_pagamento_id']) && $parcelamento['metodos_pagamento_id'] == $row['id']) ? 'selected' : '' ?>>
                            <?php echo htmlspecialchars($row['nome']); ?>
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