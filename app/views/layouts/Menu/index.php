<?php $basePath = '/MeuEstoqueVirtual/public'; ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Meu Estoque Virtual'; ?></title>
    <link rel="stylesheet" type="text/css" href="<?= $basePath . '/Css/index.css' ?>" media="screen" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?php echo $basePath; ?>/">Sistema Biblioteca</a>
            <div class="navbar-nav">
                <nav>
                    <ul>
                        <li><a class="nav-link <?php echo ($page ?? '') === 'categoria' ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/categoria">Categorias</a></li>
                        <li><a class="nav-link <?php echo ($page ?? '') === 'cliente' ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/cliente">Clientes</a></li>
                        <li><a class="nav-link <?php echo ($page ?? '') === 'compra' ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/compra">Compras</a></li>
                        <li><a class="nav-link <?php echo ($page ?? '') === 'marca' ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/marca">Marcas</a></li>
                        <li><a class="nav-link <?php echo ($page ?? '') === 'metodoPagamento' ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/metodoPagamento">Metodo Pagamento</a>
                        <li><a class="nav-link <?php echo ($page ?? '') === 'parcelamento' ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/parcelamento">Parcelamentoss</a></li>
                        <li><a class="nav-link <?php echo ($page ?? '') === 'parcela' ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/parcela">Parcelas</a></li>
                        <li><a class="nav-link <?php echo ($page ?? '') === 'pedido' ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/pedido">Pedidos</a></li>
                        <li><a class="nav-link <?php echo ($page ?? '') === 'produto' ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/produto">Produtos</a></li>
                        <li><a class="nav-link <?php echo ($page ?? '') === 'registro' ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/registro">Registros</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php echo $content ?? ''; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>