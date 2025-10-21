<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../Login/index.php");
    exit();
}

require_once __DIR__ . '/../../models/Produto/ProdutoDAO.php';
require_once __DIR__ . '../../../models/Categoria/CategoriaDAO.php';
require_once __DIR__ . '../../../models/Marca/MarcaDAO.php';

$id = $_GET["id"] ?? null;

if (!$id) {
    // Redireciona ou mostra erro se não tiver ID
    header("Location: index.php");
    exit();
}

$produtoDao = new ProdutoDAO();
$produto = $produtoDao->findById($id);    

if (!$produto) {
    echo "Produto não encontrada.";
    exit();
}

$admin = $_SESSION['admin']['id'];
$categoriaDao = new CategoriaDAO();
$categoria = $categoriaDao->showCategoria($admin);
$marcaDao = new MarcaDAO();
$marca = $marcaDao->showMarca($admin);

include '../Menu/index.php';

?>
<!DOCTYPE html>
<html>

<head>
    <title>Editar Produto</title>
    <link rel="stylesheet" type="text/css" href="../Css/form.css" media="screen" />
</head>

<body>
    <h1>Editar</h1>
    <form action="../../controllers/Produto/update.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($produto['id']) ?>">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>
        <label>Preco:</label>
        <input type="text" name="preco" value="<?= htmlspecialchars($produto['preco']) ?>" required>
        <label>Quantidade:</label>
        <input type="number" name="quantidade" value="<?= htmlspecialchars($produto['quantidade']) ?>" required>
        <label>Genero:</label>
        <select name="genero" id="genero">
    <option value="Unissex" <?= $produto['genero'] === 'Unissex' ? 'selected' : '' ?>>Unissex</option>
    <option value="Masculino" <?= $produto['genero'] === 'Masculino' ? 'selected' : '' ?>>Masculino</option>
    <option value="Feminino" <?= $produto['genero'] === 'Feminino' ? 'selected' : '' ?>>Feminino</option>
</select>
        <label>Descrição:</label>
        <input type="text" name="descricao" value="<?= htmlspecialchars($produto['descricao']) ?>" required>
        <label>Marca:</label>
    <select name="marcas_id" id="marcas_id">
        <?php foreach ($marca as $row): ?>
            <option value="<?php echo htmlspecialchars($row['id']); ?>">
                <?php echo htmlspecialchars($row['nome']); ?>
            </option>
        <?php endforeach; ?>
    </select>
        
    <label>Categoria:</label>
    <select name="categorias_id" id="categorias_id">
        <?php foreach ($categoria as $row): ?>
            <option value="<?php echo htmlspecialchars($row['id']); ?>">
                <?php echo htmlspecialchars($row['nome']); ?>
            </option>
        <?php endforeach; ?>
    </select>

        <button type="submit">Editar</button>
    </form>
    <form action="index.php" method="GET">
        <button type="submit">Voltar</button>
    </form>

</body>

</html>