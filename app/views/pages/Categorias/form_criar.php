<?php
$title = 'Categoria - Adicionar'; 
$page = 'categoria/adicionar';
$basePath = '/MeuEstoqueVirtual/public';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Adicionar marca</title>
</head>

<body>
    <h1>Adicionar</h1>
    <form action="<?= $basePath . '/categoria/criar' ?>" method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" required>
         <button type="submit">Adicionar</button>
    </form>
    <form action="<?= $basePath . '/categoria' ?>" method="GET">
        <button type="submit">Voltar</button>
    </form>

</body>

</html>