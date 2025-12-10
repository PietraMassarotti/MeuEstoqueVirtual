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
    <link rel="stylesheet" type="text/css" href="<?= $basePath . '/Css/login.css' ?>" media="screen" />
    <title>Login-MeuEstoqueVirtual</title>
</head>

<body>
    <div class="login-container">
        <img src="<?= $basePath . '/assets/logo-claudineia.jpeg' ?>" alt="Claudinéia Fashion" class="login-logo">
        <h1>Meu Estoque Virtual</h1>
        <h2>Login</h2>
        <form action="<?= $basePath . '/login/entrar' ?>" method="POST">
            <div>
                <label>E-mail:</label>
                <input type="email" name="email" placeholder="seu@email.com" required>
            </div>
            <div>
                <label>Senha:</label>
                <input type="password" name="senha" placeholder="Digite sua senha" required>
            </div>

            <button>Entrar</button>
        </form>
    </div>
</body>

</html>