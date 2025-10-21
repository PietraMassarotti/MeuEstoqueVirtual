<?php 
$title = 'Login - Sistema de Usuários'; 
$page = 'login';
$basePath = '/MeuEstoqueVirtual/public';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="" media="screen" />
    <title>Login-MeuEstoqueVirtual</title>
</head>
<body>
    <h1>Meu Estoque Virtual</h1>
    <h2>Login</h2>
    <form action="<?=$basePath . '/login/entrar'?>" method="POST">
        <label>E-mail:</label>
        <input type="email" name="email" required>
        <label>Senha:</label>
        <input type="password" name="senha" required>
        <button>Entrar</button>
    </form>
</body>
</html>
