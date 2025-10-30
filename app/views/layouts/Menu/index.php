<?php $basePath = '/MeuEstoqueVirtual/public'; ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Meu Estoque Virtual'; ?></title>
    <link rel="stylesheet" type="text/css" href="<?= $basePath . '/Css/menu.css' ?>" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?= $basePath . '/Css/tabela.css' ?>" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?= $basePath . '/Css/form.css' ?>" media="screen" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

</head>

<body>

    <!-- LOGO NO CANTO -->


    <!-- MENU PRINCIPAL -->
    <header >
        <div class="menu">
            <img src="<?= $basePath . '/assets/logo-claudineia.jpeg' ?>" alt="Claudinéia Fashion" class="logo-canto">
            <h2 class="titulo">Menu</h2>
            <ul>

                <li><a class="<?php echo ($page ?? '') === 'categoria' ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/categoria">Categorias</a></li>
                <li><a class="<?php echo ($page ?? '') === 'cliente' ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/cliente">Clientes</a></li>
                <li><a class="<?php echo ($page ?? '') === 'compra' ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/compra">Compras</a></li>
                <li><a class="<?php echo ($page ?? '') === 'marca' ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/marca">Marcas</a></li>
                <li><a class="<?php echo ($page ?? '') === 'metodoPagamento' ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/metodoPagamento">Método Pagamento</a></li>
                <li><a class="<?php echo ($page ?? '') === 'parcelamento' ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/parcelamento">Parcelamentos</a></li>
                <li><a class="<?php echo ($page ?? '') === 'parcela' ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/parcela">Parcelas</a></li>
                <li><a class="<?php echo ($page ?? '') === 'pedido' ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/pedido">Pedidos</a></li>
                <li><a class="<?php echo ($page ?? '') === 'produto' ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/produto">Produtos</a></li>
                <li><a class="<?php echo ($page ?? '') === 'registro' ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/registro">Registros</a></li>
            </ul>
        </div>
    </header>

    <!-- CONTEÚDO DA PÁGINA -->
    <main style="padding: 5rem;">
        <?php echo $content ?? ''; ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>