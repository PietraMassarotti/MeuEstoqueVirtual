<?php

declare(strict_types=1);
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/controllers/BaseController.php';
require_once __DIR__ . '/../app/controllers/CategoriaController.php';
require_once __DIR__ . '/../app/controllers/ClienteController.php';
require_once __DIR__ . '/../app/controllers/LoginController.php';
require_once __DIR__ . '/../app/controllers/MarcaController.php';
require_once __DIR__ . '/../app/controllers/MetodoPagamentoController.php';
require_once __DIR__ . '/../app/controllers/ParcelamentoController.php';
require_once __DIR__ . '/../app/controllers/PedidoController.php';
require_once __DIR__ . '/../app/controllers/ProdutoController.php';
require_once __DIR__ . '/../app/controllers/RegistroController.php';

$fullUri = $_SERVER['REQUEST_URI'];

$basePath = '/MeuEstoqueVirtual/public';

$uri = $fullUri;
if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}

if ($uri === '' || $uri === '/') {
    $uri = '/';
}

if (strpos($uri, '?') !== false) {
    $uri = substr($uri, 0, strpos($uri, '?'));
}

switch ($uri) {
    //--------------------------------
    //°*Página principal (De login)*°
    //--------------------------------
    case '/':
    case '':
        $controller = new \app\controllers\LoginController();
        $controller->showLogin();
        break;
    //Processo de login     
    case '/login/entrar':
        $controller = new \app\controllers\LoginController();
        $controller->login();
        break;

    case '/login/sair':
        $controller = new \app\controllers\LoginController();
        $controller->logout();
        break;
    //-------------------------------------------------------------------------------------------

    //--------------------------
    //°*Páginas do site e CRUD*°
    //--------------------------

    //Categoria
    case '/categoria':
        $controller = new \app\controllers\CategoriaController();
        $controller->index();
        break;

    case '/categoria/criar':
        $controller = new \app\controllers\CategoriaController();
        $controller->create();
        break;

    case '/categoria/adicionar':
        $controller = new \app\controllers\CategoriaController();
        $controller->formCreate();
        break;

    case (preg_match('/\/categoria\/editar\\/(\d+)/', $uri, $matches) ? true : false):
        $controller = new \app\controllers\CategoriaController();
        $controller->formEdit((int)$matches[1]);
        break;

    case '/categoria/salvar':
        $controller = new \app\controllers\CategoriaController();
        $controller->edit();
        break;

    case (preg_match('/\/categoria\/deletar\/(\d+)/', $uri, $matches) ? true : false):
        $controller = new \app\controllers\CategoriaController();
        $controller->delete((int)$matches[1]);
        break;
    //-------------------------------------------------------------------------------------------

    //Cliente
    case '/cliente':
        $controller = new \app\controllers\ClienteController();
        $controller->index();
        break;

    case '/cliente/criar':
        $controller = new \app\controllers\ClienteController();
        $controller->create();
        break;

    case '/cliente/adicionar':
        $controller = new \app\controllers\ClienteController();
        $controller->formCreate();
        break;

    case (preg_match('/\/cliente\/editar\\/(\d+)/', $uri, $matches) ? true : false):
        $controller = new \app\controllers\ClienteController();
        $controller->formEdit((int)$matches[1]);
        break;

    case '/cliente/salvar':
        $controller = new \app\controllers\ClienteController();
        $controller->edit();
        break;

    case (preg_match('/\/cliente\/deletar\/(\d+)/', $uri, $matches) ? true : false):
        $controller = new \app\controllers\ClienteController();
        $controller->delete((int)$matches[1]);
        break;
    //-------------------------------------------------------------------------------------------


    //Marca
    case '/marca':
        $controller = new \app\controllers\MarcaController();
        $controller->index();
        break;

    case '/marca/criar':
        $controller = new \app\controllers\MarcaController();
        $controller->create();
        break;

    case '/marca/adicionar':
        $controller = new \app\controllers\MarcaController();
        $controller->formCreate();
        break;

    case (preg_match('/\/marca\/editar\\/(\d+)/', $uri, $matches) ? true : false):
        $controller = new \app\controllers\MarcaController();
        $controller->formEdit((int)$matches[1]);
        break;

    case '/marca/salvar':
        $controller = new \app\controllers\MarcaController();
        $controller->edit();
        break;

    case (preg_match('/\/marca\/deletar\/(\d+)/', $uri, $matches) ? true : false):
        $controller = new \app\controllers\MarcaController();
        $controller->delete((int)$matches[1]);
        break;
    //-------------------------------------------------------------------------------------------

    //Metodo Pagamento
    case '/metodoPagamento':
        $controller = new \app\controllers\MetodoPagamentoController();
        $controller->index();
        break;

    case '/metodoPagamento/criar':
        $controller = new \app\controllers\MetodoPagamentoController();
        $controller->create();
        break;

    case '/metodoPagamento/adicionar':
        $controller = new \app\controllers\MetodoPagamentoController();
        $controller->formCreate();
        break;

    case (preg_match('/\/metodoPagamento\/editar\\/(\d+)/', $uri, $matches) ? true : false):
        $controller = new \app\controllers\MetodoPagamentoController();
        $controller->formEdit((int)$matches[1]);
        break;

    case '/metodoPagamento/salvar':
        $controller = new \app\controllers\MetodoPagamentoController();
        $controller->edit();
        break;

    case (preg_match('/\/metodoPagamento\/deletar\/(\d+)/', $uri, $matches) ? true : false):
        $controller = new \app\controllers\MetodoPagamentoController();
        $controller->delete((int)$matches[1]);
        break;
    //-------------------------------------------------------------------------------------------

    //Parcelamento
    case '/parcelamento':
        $controller = new \app\controllers\ParcelamentoController();
        $controller->index();
        break;

    case '/parcelamento/criar':
        $controller = new \app\controllers\ParcelamentoController();
        $controller->create();
        break;

    case '/parcelamento/adicionar':
        $controller = new \app\controllers\ParcelamentoController();
        $controller->formCreate();
        break;

    case (preg_match('/\/parcelamento\/editar\\/(\d+)/', $uri, $matches) ? true : false):
        $controller = new \app\controllers\ParcelamentoController();
        $controller->formEdit((int)$matches[1]);
        break;

    case '/parcelamento/salvar':
        $controller = new \app\controllers\ParcelamentoController();
        $controller->edit();
        break;

    case (preg_match('/\/parcelamento\/deletar\/(\d+)/', $uri, $matches) ? true : false):
        $controller = new \app\controllers\ParcelamentoController();
        $controller->delete((int)$matches[1]);
        break;
    //-------------------------------------------------------------------------------------------

    //Pedido
    case '/pedido':
        $controller = new \app\controllers\PedidoController();
        $controller->index();
        break;

    case '/pedido/criar':
        $controller = new \app\controllers\PedidoController();
        $controller->create();
        break;

    case '/pedido/adicionar':
        $controller = new \app\controllers\PedidoController();
        $controller->formCreate();
        break;

    case (preg_match('/\/pedido\/editar\\/(\d+)/', $uri, $matches) ? true : false):
        $controller = new \app\controllers\PedidoController();
        $controller->formEdit((int)$matches[1]);
        break;

    case '/pedido/salvar':
        $controller = new \app\controllers\PedidoController();
        $controller->edit();
        break;

    case (preg_match('/\/pedido\/deletar\/(\d+)/', $uri, $matches) ? true : false):
        $controller = new \app\controllers\PedidoController();
        $controller->delete((int)$matches[1]);
        break;
    //-------------------------------------------------------------------------------------------

    //Produto
    case '/produto':
        $controller = new \app\controllers\ProdutoController();
        $controller->index();
        break;

    case '/produto/criar':
        $controller = new \app\controllers\ProdutoController();
        $controller->create();
        break;

    case '/produto/adicionar':
        $controller = new \app\controllers\ProdutoController();
        $controller->formCreate();
        break;

    case (preg_match('/\/produto\/editar\\/(\d+)/', $uri, $matches) ? true : false):
        $controller = new \app\controllers\ProdutoController();
        $controller->formEdit((int)$matches[1]);
        break;

    case '/produto/salvar':
        $controller = new \app\controllers\ProdutoController();
        $controller->edit();
        break;

    case (preg_match('/\/produto\/deletar\/(\d+)/', $uri, $matches) ? true : false):
        $controller = new \app\controllers\ProdutoController();
        $controller->delete((int)$matches[1]);
        break;
    //-------------------------------------------------------------------------------------------

    //Registro
    case '/registro':
        $controller = new \app\controllers\RegistroController();
        $controller->index();
        break;

    case '/registro/criar':
        $controller = new \app\controllers\RegistroController();
        $controller->create();
        break;

    case '/registro/adicionar':
        $controller = new \app\controllers\RegistroController();
        $controller->formCreate();
        break;

    case (preg_match('/\/registro\/editar\\/(\d+)/', $uri, $matches) ? true : false):
        $controller = new \app\controllers\RegistroController();
        $controller->formEdit((int)$matches[1]);
        break;

    case '/registro/salvar':
        $controller = new \app\controllers\RegistroController();
        $controller->edit();
        break;

    case (preg_match('/\/registro\/deletar\/(\d+)/', $uri, $matches) ? true : false):
        $controller = new \app\controllers\RegistroController();
        $controller->delete((int)$matches[1]);
        break;
    //-------------------------------------------------------------------------------------------


    //°*Caso de erro*°
    default:
        http_response_code(404);
        echo "<div class='container mt-4'><h1>404 - Página não encontrada</h1>";
        echo "<p>A página solicitada não existe.</p>";
        echo "<a href='{$basePath}/produto' class='btn btn-primary'>Voltar para Home</a></div>";
        break;
}
