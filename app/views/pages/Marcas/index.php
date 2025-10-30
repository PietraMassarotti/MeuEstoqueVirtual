<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../Login/index.php");
    exit();
}

use App\Models\Marca\MarcaDAO;

$admin = $_SESSION['admin']['id'];
$marcaDao = new MarcaDAO();
$resultado = $marcaDao->showMarca($admin);

$title = 'Marca';
$page = 'marca';
$basePath = '/MeuEstoqueVirtual/public';
?>

<body>
    <div class="main-container">
        <h1>Gerenciamento de Marcas</h1>

        <!-- Botão adicionar -->
        <a href="<?= $basePath . '/marca/adicionar' ?>" class="btn-add">Adicionar</a>

        <!-- Tabela -->
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

        <!-- Botão sair -->
        <div class="actions">
            <a href="<?= $basePath . '/login/sair' ?>" class="btn btn-exit">Sair</a>
        </div>
    </div>

    <!-- Logo fixa -->
    <img src="<?= $basePath . '/assets/logo-claudineia.jpeg' ?>" alt="Logo Claudinéia" class="logo-fixed">
</body>

</html>
