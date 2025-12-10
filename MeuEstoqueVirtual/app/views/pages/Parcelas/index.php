<?php

use App\Models\Parcela\ParcelaDAO;

$parcelaDao = new ParcelaDAO();
$resultado = $parcelaDao->showParcelas();

$title = 'Parcelas - Sistema de Usuários';
$page = 'parcelas';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="main-container">

    <h1>Gerenciamento de Parcelas</h1>

    <a href="<?= $basePath . '/parcela/adicionar' ?>">Adicionar Parcela</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Número</th>
                <th>Valor</th>
                <th>Data Vencimento</th>
                <th>Status</th>
                <th>Cliente</th>
                <th>Compra ID</th>
                <th>Criado em</th>
                <th>Atualizado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultado as $row): ?>
                <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= $row['numero'] ?></td>
                    <td>R$ <?= number_format($row['valor'], 2, ',', '.') ?></td>
                    <td><?= date('d/m/Y', strtotime($row['data'])) ?></td>
                    <td><?= htmlspecialchars($row['status']) ?></td>
                    <td><?= htmlspecialchars($row['cliente_nome'] ?? 'N/A') ?></td>
                    <td><?= $row['compras_id'] ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($row['create_at'])) ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($row['update_at'])) ?></td>
                    <td class="btn-actions">
                        <a href="<?= $basePath . '/parcela/editar/' . $row['id'] ?>" class="btn btn-edit">Editar</a>
                        <a href="<?= $basePath . '/parcela/deletar/' . $row['id'] ?>" class="btn btn-delete" onclick="return confirm('Tem certeza?')">Deletar</a>
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