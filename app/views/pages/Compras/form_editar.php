<?php

$id = $_GET["id"];

?>


<!DOCTYPE html>
<html>

<head>
    <title>Adicionar marca</title>
    <link rel="stylesheet" type="text/css" href="css/form.css" media="screen" />
</head>

<body>
    <h1>Adicionar</h1>
    <form action="../../controllers/Marca/criar_livro.php" method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" required>
         <button type="submit">Editar</button>
    </form>
    <form action="index.php" method="GET">
        <button type="submit">Voltar</button>
    </form>

</body>

</html>