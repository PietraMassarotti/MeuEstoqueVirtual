<?php
require_once __DIR__ . '/../../models/MetodoPagamento/MetodoPagamentoDAO.php';

$id = $_GET["id"] ?? null;

if (!$id) {
    // Redireciona ou mostra erro se não tiver ID
    header("Location: index.php");
    exit();
}

$metodoPagamentoDao = new MetodoPagamentoDAO();
$metodoPagamento = $metodoPagamentoDao->findById($id);

if (!$metodoPagamento) {
    echo "Marca não encontrada.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Metodo de Pagamento</title>
    <link rel="stylesheet" type="text/css" href="../Css/form.css" media="screen" />
</head>
<body>
    <h1>Editar Metodo de Pagamento</h1>

    <form action="../../controllers/MetodoPagamento/update.php" method="POST">
        <!-- Campo oculto para enviar o ID -->
        <input type="hidden" name="id" value="<?= htmlspecialchars($metodoPagamento['id']) ?>">

        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($metodoPagamento['nome']) ?>" required>

        <button type="submit">Salvar Alterações</button>
    </form>

    <form action="index.php" method="GET">
        <button type="submit">Voltar</button>
    </form>
</body>
</html>
