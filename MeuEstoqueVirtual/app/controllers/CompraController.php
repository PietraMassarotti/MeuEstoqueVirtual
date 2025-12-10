<?php

/**
 * Controlador de Compras
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Utils\Sanitizacao;

class CompraController extends BaseController
{
    /**
     * Mostra a página principal de Compras
     * @return void
     */
    public function index(): void
    {
        $this->render('Compras/index');
    }

    /**
     * Mostra o formulário/página para adicionar os dados
     * @return void
     */
    public function formCreate(): void
    {
        $this->render('Compras/form_criar');
    }

    /*
    *Mostra o formulário/página para editar os dados
    */
    public function formEdit(int $id): void
    {
        $this->render('Compras/form_editar', ['id' => $id]);
    }

    /*
    *Adiciona os dados no banco 
    */
    public function create(): void
    {
        $pedidos_id = Sanitizacao::sanitizar($_POST['pedidos_id']);
        $parcelamentos_id = Sanitizacao::sanitizar($_POST['parcelamentos_id']);

        $compraDAO = new \App\Models\Compra\CompraDAO();
        $compra = $compraDAO->createCompra($pedidos_id, $parcelamentos_id);

        $this->redirect('/compra');
    }

    /*
    *Edita os dados no banco
    */
    public function edit(): void
    {
        $id = Sanitizacao::sanitizar($_POST['id']);
        $pedidos_id = Sanitizacao::sanitizar($_POST['pedidos_id']);
        $parcelamentos_id = Sanitizacao::sanitizar($_POST['parcelamentos_id']);

        $compraDAO = new \App\Models\Compra\CompraDAO();
        $compra = $compraDAO->updateCompra($id, $pedidos_id, $parcelamentos_id);

        $this->redirect('/compra');
    }

    /*
    * Deleta os dados no banco
    */
    public function delete(int $id): void
    {
        session_start();

        try {
            $compraDAO = new \App\Models\Compra\CompraDAO();
            $compraDAO->deleteCompra($id);

            $_SESSION['mensagem'] = "Compra excluída com sucesso!";
            $_SESSION['tipo_mensagem'] = "success";
        } catch (\Exception $e) {

            $_SESSION['mensagem'] = $e->getMessage();
            $_SESSION['tipo_mensagem'] = "error";
        }

        $this->redirect('/compra');
    }
}
