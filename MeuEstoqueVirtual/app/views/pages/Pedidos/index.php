<?php

use App\Models\Pedido\PedidoDAO;

$pedidoDao = new PedidoDAO();
$resultado = $pedidoDao->showPedido();

$title = 'pedido - Sistema de Usuários';
$page = 'pedido';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="main-container">

    <h1>Gerenciamento de pedidos</h1>

    <a href="<?= $basePath . '/pedido/adicionar' ?>">Adicionar</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultado as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row["id"]) ?></td>
                    <td><?= htmlspecialchars($row["cliente_nome"]) ?></td>
                    <td class="btn-actions">
                        <a href="<?= $basePath . '/pedido/editar/' . $row['id'] ?>" class="btn btn-edit">Editar</a>
                        <a href="<?= $basePath . '/pedido/deletar/' . $row['id'] ?>" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir este pedido?');">Deletar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="actions">
    <a href="<?= $basePath . '/login/sair' ?>" class="btn btn-exit">Sair</a>
</div>

<img src="<?= $basePath . '/assets/logo-claudineia.jpeg' ?>" alt="Logo Claudinéia" class="logo-fixed">