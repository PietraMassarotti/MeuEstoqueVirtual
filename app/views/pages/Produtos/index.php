<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../Login/index.php");
    exit();
}

use App\Models\Produto\ProdutoDAO;

$admin = $_SESSION['admin']['id'];
$produtoDao = new ProdutoDAO();
$resultado = $produtoDao->showProduto($admin);

$title = 'Produto - Sistema de Usuários';
$page = 'produto';
$basePath = '/MeuEstoqueVirtual/public';
?>

<!-- Container principal -->
<div class="main-container">

    <h1>Gerenciamento de Produtos</h1>

    <!-- Botão adicionar -->
    <a href="<?= $basePath . '/produto/adicionar' ?>">Adicionar</a>

    <!-- Tabela de produtos -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Gênero</th>
                <th>Descrição</th>
                <th>Marca</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultado as $row): ?>
                <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= htmlspecialchars($row['nome']) ?></td>
                    <td><?= htmlspecialchars($row['preco']) ?></td>
                    <td><?= htmlspecialchars($row['quantidade']) ?></td>
                    <td><?= htmlspecialchars($row['genero']) ?></td>
                    <td><?= htmlspecialchars($row['descricao']) ?></td>
                    <td><?= htmlspecialchars($row['marca_nome']) ?></td>
                    <td><?= htmlspecialchars($row['categoria_nome']) ?></td>
                    <td class="btn-actions">
                        <a href="<?= $basePath . '/produto/editar/' . $row['id'] ?>" class="btn btn-edit">Editar</a>
                        <a href="<?= $basePath . '/produto/deletar/' . $row['id'] ?>" class="btn btn-delete">Deletar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Botão fixo de sair -->
<div class="actions">
    <a href="<?= $basePath . '/login/sair' ?>" class="btn btn-exit">Sair</a>
</div>

<!-- Logo fixa no canto inferior esquerdo -->
<img src="<?= $basePath . '/assets/logo-claudineia.jpeg' ?>" alt="Logo Claudinéia" class="logo-fixed">
