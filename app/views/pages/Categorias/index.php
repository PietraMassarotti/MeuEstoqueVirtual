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


<body>

    <!-- CONTAINER PRINCIPAL -->
    <div class="main-container">

        <h1>Gerenciamento de Categorias</h1>

        <!-- BOTÃO ADICIONAR -->
        <a href="<?= $basePath . '/categoria/adicionar' ?>">Adicionar</a>

        <!-- TABELA DE CATEGORIAS -->
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
                            <a href="<?= $basePath . '/categoria/deletar/' . $row['id'] ?>" class="btn btn-delete">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <!-- BOTÃO SAIR FIXO -->
    <div class="actions">
        <a href="<?= $basePath . '/login/sair' ?>" class="btn btn-exit">Sair</a>
    </div>

    <!-- LOGO FIXA NO CANTO INFERIOR ESQUERDO -->
    <img src="<?= $basePath . '/assets/logo-claudineia.jpeg' ?>" alt="Logo Claudinéia" class="logo-fixed">

</body>

</html>