<?php

use App\Models\Cliente\ClienteDAO;
use App\Utils\Validacao;

session_start();

if (isset($_SESSION['mensagem'])) {
    echo "<div class='message error'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']);
}


$clienteDao = new ClienteDAO();
$resultado = $clienteDao->showCliente();

$title = 'Cliente';
$page = 'cliente';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="main-container">

    <h1>Gerenciamento de Clientes</h1>

    <?php if (isset($_SESSION['mensagem'])): ?>
        <div class="alert alert-<?= $_SESSION['tipo_mensagem'] === 'success' ? 'success' : 'danger' ?>" style="padding: 15px; margin-bottom: 20px; border-radius: 5px; background-color: <?= $_SESSION['tipo_mensagem'] === 'success' ? '#d4edda' : '#f8d7da' ?>; color: <?= $_SESSION['tipo_mensagem'] === 'success' ? '#155724' : '#721c24' ?>; border: 1px solid <?= $_SESSION['tipo_mensagem'] === 'success' ? '#c3e6cb' : '#f5c6cb' ?>;">
            <?= htmlspecialchars($_SESSION['mensagem']) ?>
        </div>
        <?php
        unset($_SESSION['mensagem']);
        unset($_SESSION['tipo_mensagem']);
        ?>
    <?php endif; ?>

    <a href="<?= $basePath . '/cliente/adicionar' ?>">Adicionar</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Nascimento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultado as $row): ?>
                <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= htmlspecialchars($row['nome']) ?></td>
                    <td><?= htmlspecialchars($row["email"]) ?></td>
                    <td><?= htmlspecialchars($row['endereco']) ?></td>
                    <td><?= Validacao::exibirTelefone($row["telefone"]) ?></td>
                    <td><?= htmlspecialchars($row['nasc']) ?></td>
                    <td class="btn-actions">
                        <a href="<?= $basePath . '/cliente/editar/' . $row['id'] ?>" class="btn btn-edit">Editar</a>
                        <a href="<?= $basePath . '/cliente/deletar/' . $row['id'] ?>" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir este cliente?');">Deletar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<div class="actions">
    <a href="../../controllers/Admin/logout.php" class="btn btn-exit">Sair</a>
</div>

<img src="<?= $basePath . '/assets/logo-claudineia.jpeg' ?>" alt="Logo Claudinéia" class="logo-fixed">