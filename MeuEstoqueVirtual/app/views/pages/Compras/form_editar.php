<?php

use App\Models\Compra\CompraDAO;

// O $id já vem do controller via extract($data)
if (!isset($id) || !$id) {
    header("Location: /MeuEstoqueVirtual/public/compra");
    exit();
}

$compraDao = new CompraDAO();
$compra = $compraDao->findById($id);

if (!$compra) {
    header("Location: /MeuEstoqueVirtual/public/compra");
    exit();
}

$pedidos = $compraDao->getAllPedidos();
$parcelamentos = $compraDao->getAllParcelamentos();

$title = 'Editar Compra - Sistema de Estoque';
$page = 'compra';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="main-container">
    <h1>✏️ Editar Compra #<?= $compra['id'] ?></h1>

    <form action="<?= $basePath . '/compra/salvar' ?>" method="POST">
        <input type="hidden" name="id" value="<?= $compra['id'] ?>">

        <label for="pedidos_id">Pedido:</label>
        <select name="pedidos_id" id="pedidos_id" required>
            <option value="">Selecione um pedido</option>
            <?php foreach ($pedidos as $pedido): ?>
                <option value="<?= $pedido['id'] ?>"
                    <?= $pedido['id'] == $compra['pedidos_id'] ? 'selected' : '' ?>>
                    Pedido #<?= $pedido['id'] ?> - Cliente: <?= htmlspecialchars($pedido['cliente_nome']) ?>
                    (<?= date('d/m/Y', strtotime($pedido['create_at'])) ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label for="parcelamentos_id">Parcelamento:</label>
        <select name="parcelamentos_id" id="parcelamentos_id" required>
            <option value="">Selecione um parcelamento</option>
            <?php foreach ($parcelamentos as $parcelamento): ?>
                <option value="<?= $parcelamento['id'] ?>"
                    <?= $parcelamento['id'] == $compra['parcelamentos_id'] ? 'selected' : '' ?>>
                    Parcelamento #<?= $parcelamento['id'] ?> -
                    <?= $parcelamento['quantidade'] ?>x -
                    Juros: <?= number_format($parcelamento['taxa de juros'], 2, ',', '.') ?>%
                </option>
            <?php endforeach; ?>
        </select>

        <div class="form-group">
            <label>Criado em:</label>
            <input type="text" value="<?= date('d/m/Y H:i', strtotime($compra['create_at'])) ?>" disabled>
        </div>

        <div class="form-group">
            <label>Atualizado em:</label>
            <input type="text" value="<?= date('d/m/Y H:i', strtotime($compra['update_at'])) ?>" disabled>
        </div>

        <button type="submit">Salvar Alterações</button>
        <a href="<?= $basePath . '/compra' ?>" class="btn-secondary">Voltar</a>
    </form>
</div>

<div class="actions">
    <a href="<?= $basePath . '/login/sair' ?>" class="btn btn-exit">Sair</a>
</div>

<img src="<?= $basePath . '/assets/logo-claudineia.jpeg' ?>" alt="Logo Claudinéia" class="logo-fixed">