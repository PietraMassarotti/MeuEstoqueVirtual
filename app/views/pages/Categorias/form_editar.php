<?php

use App\Models\Categoria\CategoriaDAO;

$categoriaDao = new CategoriaDAO();
$categoria = $categoriaDao->findById($id);

if (!$categoria) {
    echo "Categoria não encontrada.";
    exit();
}
$title = 'Categoria - Editar ';
$page = 'categoria/editar';
$basePath = '/MeuEstoqueVirtual/public';
?>

<h1>Editar Categoria</h1>

<form action="<?= $basePath . '/categoria/salvar' ?>" method="POST">
    <!-- Campo oculto para enviar o ID -->
    <input type="hidden" name="id" value="<?= htmlspecialchars($categoria['id']) ?>">

    <label>Nome:</label>
    <input type="text" name="nome" value="<?= htmlspecialchars($categoria['nome']) ?>" required>

    <button type="submit">Salvar Alterações</button>
</form>

<form action="<?= $basePath . '/categoria' ?>" method="GET">
    <button type="submit">Voltar</button>
</form>