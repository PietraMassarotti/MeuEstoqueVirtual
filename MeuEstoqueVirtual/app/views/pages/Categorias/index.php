<?php

use App\Models\Categoria\CategoriaDAO;

session_start();

if (isset($_SESSION['mensagem'])) {
    echo "<div class='message error'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']);
}

$categoriaDao = new CategoriaDAO();
$resultado = $categoriaDao->showCategoria();

$title = 'Categoria';
$page = 'categoria';
$basePath = '/MeuEstoqueVirtual/public';
?>


<div class="main-container">

    <h1>Gerenciamento de Categorias</h1>

    <a href="<?= $basePath . '/categoria/adicionar' ?>">Adicionar</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultado as $row): ?>
                <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= htmlspecialchars($row['nome']) ?></td>
                    <td class="btn-actions">
                        <a href="<?= $basePath . '/categoria/editar/' . $row['id'] ?>" class="btn btn-edit">Editar</a>
                        <a href="<?= $basePath . '/categoria/deletar/' . $row['id'] ?>" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir esta categoria?');">Deletar</a>
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