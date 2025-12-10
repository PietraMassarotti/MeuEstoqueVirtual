<?php

use App\Models\Registro\RegistroDAO;

$registroDao = new RegistroDAO();
$resultado = $registroDao->showRegistro();

$title = 'Registro - Sistema de Usuários';
$page = 'registro';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="main-container">

    <h1>Gerenciamento de Registros</h1>

    <a href="<?= $basePath . '/registro/adicionar' ?>">Adicionar</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Quantidade</th>
                <th>Ação</th>
                <th>Descrição</th>
                <th>Produto</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultado as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row["id"]) ?></td>
                    <td><?= htmlspecialchars($row["quantidade"]) ?></td>
                    <td><?= htmlspecialchars($row["acao"]) ?></td>
                    <td><?= htmlspecialchars($row["descricao"]) ?></td>
                    <td><?= htmlspecialchars($row["produto_nome"]) ?></td>
                    <td class="btn-actions">
                        <a href="<?= $basePath . '/registro/deletar/' . $row['id'] ?>" class="btn btn-delete">Deletar</a>
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