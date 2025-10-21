<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../Login/index.php");
    exit();
}

use App\Models\Categoria\CategoriaDAO;

$admin = $_SESSION['admin']['id'];
$categoriaDao = new CategoriaDAO();
$resultado = $categoriaDao->showCategoria($admin);

$title = 'Categoria';
$page = 'categoria';
$basePath = '/MeuEstoqueVirtual/public';
?>

<a href="<?= $basePath . '/categoria/adicionar' ?>">Adicionar Categoria</a>
<br>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Categoria</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($resultado as $row): ?>
            <tr>
                <td><?= $row["id"] ?></td>
                <td><?= $row['nome'] ?></td>
                <td class="btn-actions">
                    <a href="<?= $basePath . '/categoria/editar/' . $row['id'] ?>" class="btn btn-edit">Editar</a>
                    <a href="<?= $basePath . '/categoria/deletar/' . $row['id'] ?>" class="btn btn-delete">Deletar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="actions">
    <a href="<?= $basePath . '/login/sair' ?>" class="btn btn-exit">Sair</a>
</div>