<?php

use App\Models\Produto\ProdutoDAO;

session_start();

if (isset($_SESSION['mensagem'])) {
    echo "<div class='message error'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']);
}

$produtoDao = new ProdutoDAO();
$resultado = $produtoDao->showProduto();

$title = 'Produto - Sistema de Usuários';
$page = 'produto';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="main-container">

    <h1>Gerenciamento de Produtos</h1>

    <a href="<?= $basePath . '/produto/adicionar' ?>">Adicionar</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Gênero</th>
                <th>Descrição</th>
                <th>Data Validade</th>
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
                    <td><?= !empty($row['data_validade']) ? date('d/m/Y', strtotime($row['data_validade'])) : '-' ?></td>
                    <td><?= htmlspecialchars($row['marca_nome']) ?></td>
                    <td><?= htmlspecialchars($row['categoria_nome']) ?></td>
                    <td class="btn-actions">
                        <a href="<?= $basePath . '/produto/editar/' . $row['id'] ?>" class="btn btn-edit">Editar</a>
                        <a href="<?= $basePath . '/produto/deletar/' . $row['id'] ?>" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir este produto?');">Deletar</a>
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