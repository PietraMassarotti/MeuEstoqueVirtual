<?php
    session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../Login/index.php");
    exit();
}

require_once __DIR__ . '../../../models/Categoria/CategoriaDAO.php';
require_once __DIR__ . '../../../models/Marca/MarcaDAO.php';

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
    <title>Adicionar produto</title>
    <link rel="stylesheet" type="text/css" href="../Css/form.css" media="screen" />
</head>

<body>
    <h1>Adicionar</h1>
    <form action="../../controllers/Produto/create.php" method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" required>
        <label>Preço:</label>
    <input type="text" name="preco" required>

    <label>Quantidade:</label>
    <input type="number" id="quantidade" name="quantidade" required>

    <label>Genero:</label>
    <select name="genero" id="genero">
        <option value="Unissex">Unissex</option>
        <option value="Masculino">Masculino</option>
        <option value="Feminino">Feminino</option>
    </select>

    <label>Descrição:</label>
    <input type="text" name="descricao" required>

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

    <button type="submit">Adicionar</button>
</form>

<form action="index.php" method="GET">
    <button type="submit">Voltar</button>
</form>

</body>

</html>