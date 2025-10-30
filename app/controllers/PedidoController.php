<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Pedido\PedidoDAO;
use App\Utils\Sanitizacao;
use App\Utils\Validacao;

class PedidoController extends BaseController
{
    /**
     * Mostra a lista de usuários
     * @return void
     */
    public function index(): void
    {
        $this->render('Pedidos/index');
    }

    /**
     * Mostra formulário de criação
     * @return void
     */
    public function create(): void
    {

        $clientes_id = Sanitizacao::sanitizar($_POST['clientes_id']);

        $PedidoDAO = new PedidoDAO();
        $pedido = $PedidoDAO->createPedido($clientes_id);

        $this->redirect('/pedido');
    }

    /**
     * Mostra formulário de edição
     * @param int $id ID do usuário
     * @return void
     */
    public function edit(): void
    {
        $pedidoDao = new \App\Models\Pedido\PedidoDAO();

        $id = Sanitizacao::sanitizar($_POST['id']);
        $clientes_id = Sanitizacao::sanitizar($_POST['clientes_id']); // Corrigido

        $pedidoDao->updatePedido($id, $clientes_id);


        $this->redirect('/pedido');
    }

    public function formCreate(): void
    {
        $this->render('Pedidos/form_criar');
    }

    public function formEdit(int $id): void
    {
        $this->render('Pedidos/form_editar', ['id' => $id]);
    }

    /**
     * Deleta usuário
     * @param int $id ID do usuário
     * @return void
     */
    public function delete(int $id): void
    {
        $PedidoDAO = new \App\Models\Pedido\PedidoDAO();
        $pedido = $PedidoDAO->deletePedido($id);

        $this->redirect('/pedido');
    }
}
