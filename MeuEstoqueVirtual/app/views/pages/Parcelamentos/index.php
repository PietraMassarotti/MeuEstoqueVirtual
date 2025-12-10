<?php

use App\Models\Parcelamento\ParcelamentoDAO;

session_start();

if (isset($_SESSION['mensagem'])) {
    echo "<div class='message error'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']);
}


$parcelamentoDao = new ParcelamentoDAO();
$resultado = $parcelamentoDao->showParcelamento();

$title = 'Parcelamento - Sistema de Usuários';
$page = 'parcelamento';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="main-container">

    <h1>Gerenciamento de Parcelamentos</h1>

    <a href="<?= $basePath . '/parcelamento/adicionar' ?>">Adicionar</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Quantidade</th>
                <th>Taxa de Juros (%)</th>
                <th>Método de Pagamento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultado as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row["id"]) ?></td>
                    <td><?= htmlspecialchars($row["quantidade"]) ?>x</td>
                    <td><?= number_format($row["taxa_juros"], 2, ',', '.') ?>%</td>
                    <td><?= htmlspecialchars($row["metodo_pagamento_nome"] ?? 'N/A') ?></td>
                    <td class="btn-actions">
                        <a href="<?= $basePath . '/parcelamento/editar/' . $row['id'] ?>" class="btn btn-edit">Editar</a>
                        <a href="<?= $basePath . '/parcelamento/deletar/' . $row['id'] ?>" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir este parcelamento?');">Deletar</a>
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