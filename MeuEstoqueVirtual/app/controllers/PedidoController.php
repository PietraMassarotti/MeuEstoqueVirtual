<?php

/**
 * Controlador de Pedidos
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Pedido\PedidoDAO;
use App\Utils\Sanitizacao;
use App\Utils\Validacao;

class PedidoController extends BaseController
{
    /**
     * Mostra a página principal de Pedidos
     * @return void
     */
    public function index(): void
    {
        $this->render('Pedidos/index');
    }

    /**
     * Mostra o formulário/página para adicionar os dados
     * @return void
     */
    public function formCreate(): void
    {
        $this->render('Pedidos/form_criar');
    }

    /*
    *Mostra o formulário/página para editar os dados
    */
    public function formEdit(int $id): void
    {
        $this->render('Pedidos/form_editar', ['id' => $id]);
    }

    /*
    *Adiciona os dados no banco 
    */
    public function create(): void
    {

        $clientes_id = Sanitizacao::sanitizar($_POST['clientes_id']);

        $PedidoDAO = new PedidoDAO();
        $pedido = $PedidoDAO->createPedido($clientes_id);

        $this->redirect('/pedido');
    }

    /*
    *Edita os dados no banco
    */
    public function edit(): void
    {
        $pedidoDao = new \App\Models\Pedido\PedidoDAO();

        $id = Sanitizacao::sanitizar($_POST['id']);
        $clientes_id = Sanitizacao::sanitizar($_POST['clientes_id']); // Corrigido

        $pedidoDao->updatePedido($id, $clientes_id);


        $this->redirect('/pedido');
    }

    /*
    * Deleta os dados no banco
    */
    public function delete(int $id): void
    {
        session_start();

        try {
            $PedidoDAO = new \App\Models\Pedido\PedidoDAO();
            $pedido = $PedidoDAO->deletePedido($id);

        } catch (\Exception $e) {
            // Mensagem de erro
            $_SESSION['mensagem'] = $e->getMessage();
            $_SESSION['tipo_mensagem'] = 'error';
        }

        $this->redirect('/pedido');
    }
}
