<?php

use App\Models\Compra\CompraDAO;

session_start();

if (isset($_SESSION['mensagem'])) {
    echo "<div class='message error'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']);
}

$compraDao = new CompraDAO();
$compras = $compraDao->showCompras();
$produtosEstoqueBaixo = $compraDao->getProdutosEstoqueBaixo();

$title = 'Compras - Sistema de Estoque';
$page = 'compra';
$basePath = '/MeuEstoqueVirtual/public';
?>

<style>
    .alerta-estoque {
        background: #ffe6e6 !important;
        border-left: 4px solid #ff4444;
    }

    .alerta-estoque td {
        color: #cc0000 !important;
        font-weight: 600;
    }

    .badge-baixo {
        background: #ff4444;
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 15px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .section-alerta {
        background: #fff5f5;
        border: 2px solid #ff4444;
        border-radius: 15px;
        padding: 1.5rem;
        margin: 2rem 0;
    }

    .section-alerta h2 {
        color: #cc0000;
        margin-bottom: 1rem;
        font-size: 1.5rem;
    }
</style>

<div class="main-container">

    <h1>📦 Gerenciamento de Compras</h1>

    <?php if (count($produtosEstoqueBaixo) > 0): ?>
        <div class="section-alerta">
            <h2>⚠️ ALERTA: Produtos com Estoque Baixo (< 7 unidades)</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Marca</th>
                                <th>Categoria</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produtosEstoqueBaixo as $produto): ?>
                                <tr class="alerta-estoque">
                                    <td><?= $produto['id'] ?></td>
                                    <td><?= htmlspecialchars($produto['nome']) ?></td>
                                    <td>
                                        <span class="badge-baixo">
                                            <?= $produto['quantidade'] ?> unidades
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($produto['marca_nome']) ?></td>
                                    <td><?= htmlspecialchars($produto['categoria_nome']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
        </div>
    <?php endif; ?>

    <a href="<?= $basePath . '/compra/adicionar' ?>">Adicionar Compra</a>

    <h2>📋 Lista de Compras</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Criado em</th>
                <th>Atualizado em</th>
                <th>Pedido</th>
                <th>Parcelamento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($compras) > 0): ?>
                <?php foreach ($compras as $row): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($row['create_at'])) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($row['update_at'])) ?></td>
                        <td>Pedido #<?= $row['pedidos_id'] ?></td>
                        <td>Parcelamento #<?= $row['parcelamentos_id'] ?></td>
                        <td class="btn-actions">
                            <a href="<?= $basePath . '/compra/editar/' . $row['id'] ?>" class="btn btn-edit">Editar</a>
                            <a href="<?= $basePath . '/compra/deletar/' . $row['id'] ?>"
                                class="btn btn-delete"
                                onclick="return confirm('Tem certeza que deseja deletar esta compra?')">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Nenhuma compra cadastrada</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="actions">
    <a href="<?= $basePath . '/login/sair' ?>" class="btn btn-exit">Sair</a>
</div>

<img src="<?= $basePath . '/assets/logo-claudineia.jpeg' ?>" alt="Logo Claudinéia" class="logo-fixed">