<?php

use App\Models\MetodoPagamento\MetodoPagamentoDAO;

session_start();

if (isset($_SESSION['mensagem'])) {
    echo "<div class='message error'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']);
}

$metodoPagamentoDao = new MetodoPagamentoDAO();
$resultado = $metodoPagamentoDao->showMetodoPagamento();

$title = 'Método de Pagamento';
$page = 'metodoPagamento';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="main-container">
    <h1>Gerenciamento de Métodos de Pagamento</h1>

    <a href="<?= $basePath . '/metodoPagamento/adicionar' ?>">Adicionar</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Método</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultado as $row): ?>
                <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= $row['nome'] ?></td>
                    <td class="btn-actions">
                        <a href="<?= $basePath . '/metodoPagamento/editar/' . $row['id'] ?>" class="btn btn-edit">Editar</a>
                        <a href="<?= $basePath . '/metodoPagamento/deletar/' . $row['id'] ?>" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir este método de pagamento?');">Deletar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="actions">
        <a href="<?= $basePath . '/login/sair' ?>" class="btn btn-exit">Sair</a>
    </div>
</div>

<img src="<?= $basePath . '/assets/logo-claudineia.jpeg' ?>" alt="Logo Claudinéia" class="logo-fixed">