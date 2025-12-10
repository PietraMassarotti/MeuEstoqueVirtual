<?php

use App\Models\Compra\CompraDAO;

$compraDao = new CompraDAO();
$pedidos = $compraDao->getAllPedidos();
$parcelamentos = $compraDao->getAllParcelamentos();

$title = 'Adicionar Compra - Sistema de Usuários';
$page = 'compras';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="all">
    <div class="body">
        <div class="form-container">

            <h1>📦 Adicionar Nova Compra</h1>

            <form action="<?= $basePath . '/compra/criar' ?>" method="POST">

                <label for="pedidos_id">Pedido:</label>
                <select name="pedidos_id" id="pedidos_id" required class="form-select">
                    <?php foreach ($pedidos as $pedido): ?>
                        <option value="<?= $pedido['id'] ?>">
                            Pedido #<?= $pedido['id'] ?> - Cliente: <?= htmlspecialchars($pedido['cliente_nome']) ?>
                            (<?= date('d/m/Y', strtotime($pedido['create_at'])) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="parcelamentos_id">Parcelamento:</label>
                <select name="parcelamentos_id" id="parcelamentos_id" required class="form-select">
                    <?php foreach ($parcelamentos as $parcelamento): ?>
                        <option value="<?= $parcelamento['id'] ?>">
                            Parcelamento #<?= $parcelamento['id'] ?> -
                            <?= $parcelamento['quantidade'] ?>x -
                            Juros: <?= number_format($parcelamento['taxa_juros'], 2, ',', '.') ?>%
                        </option>
                    <?php endforeach; ?>
                </select>

                <div class="form-actions">
                    <button type="submit">Adicionar Compra</button>
                </div>
            </form>

            <form action="<?= $basePath . '/compra' ?>" method="GET">
                <div class="form-actions">
                    <button type="submit">Voltar</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="actions">
    <a href="<?= $basePath . '/login/sair' ?>" class="btn btn-exit">Sair</a>
</div>

<img src="<?= $basePath . '/assets/logo-claudineia.jpeg' ?>" alt="Logo Claudinéia" class="logo-fixed">