<?php
session_start();

use App\Models\Marca\MarcaDAO;

if (isset($_SESSION['mensagem'])) {
    echo "<div class='message error'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']);
}

$marcaDao = new MarcaDAO();
$resultado = $marcaDao->showMarca();

$title = 'Marca';
$page = 'marca';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="main-container">
    <h1>Gerenciamento de Marcas</h1>

    <a href="<?= $basePath . '/marca/adicionar' ?>" class="btn-add">Adicionar</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultado as $row): ?>
                <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= $row['nome'] ?></td>
                    <td class="btn-actions">
                        <a href="<?= $basePath . '/marca/editar/' . $row['id'] ?>" class="btn btn-edit">Editar</a>
                        <a href="<?= $basePath . '/marca/deletar/' . $row['id'] ?>" class="btn btn-delete">Deletar</a>
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