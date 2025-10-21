<?php
require_once __DIR__ . '/../../models/Marca/MarcaDAO.php';

$id = $_GET["id"] ?? null;

if (!$id) {
    // Redireciona ou mostra erro se não tiver ID
    header("Location: index.php");
    exit();
}

$marcaDao = new MarcaDAO();
$marca = $marcaDao->findById($id);

if (!$marca) {
    echo "Marca não encontrada.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar marca</title>
    <link rel="stylesheet" type="text/css" href="../Css/form.css" media="screen" />
</head>
<body>
    <h1>Editar Marca</h1>

    <form action="../../controllers/Marca/update.php" method="POST">
        <!-- Campo oculto para enviar o ID -->
        <input type="hidden" name="id" value="<?= htmlspecialchars($marca['id']) ?>">

        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($marca['nome']) ?>" required>

        <button type="submit">Salvar Alterações</button>
    </form>

    <form action="index.php" method="GET">
        <button type="submit">Voltar</button>
    </form>
</body>
</html>
