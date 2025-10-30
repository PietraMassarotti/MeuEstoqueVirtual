<?php

/**
 * Controlador de Autenticação
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Utils\Sanitizacao;

class MetodoPagamentoController extends BaseController
{
    /**
     * Mostra a página de Marca
     * @return void
     */
    public function index(): void
    {
        $this->render('MetodosPagamento/index');
    }

    public function create(): void
    {
        $marcaDao = new \App\Models\MetodoPagamento\MetodoPagamentoDAO();
        $nome = Sanitizacao::sanitizar($_POST['nome']);

        $MetodoPagamentoDAO = new \App\Models\MetodoPagamento\MetodoPagamentoDAO();
        $metodoPagamento = $MetodoPagamentoDAO->createMetodoPagamento($nome);

        $this->redirect('/metodoPagamento');
    }

    public function formCreate(): void
    {
        $this->render('MetodosPagamento/form_criar');
    }


    public function edit(): void
    {
        $id = Sanitizacao::sanitizar($_POST['id']);
        $nome = Sanitizacao::sanitizar($_POST['nome']);

        $MetodoPagamentoDAO = new \App\Models\MetodoPagamento\MetodoPagamentoDAO();
        $metodoPagamento = $MetodoPagamentoDAO->updateMetodoPagamento($id, $nome);

        $this->redirect('/metodoPagamento');
    }

    public function formEdit(int $id): void
    {
        $this->render('MetodosPagamento/form_editar', ['id' => $id]);
    }

    public function save(): void
    {
        $this->render('MetodosPagamento/index');
    }

    public function delete(int $id): void
    {
        session_start();
        $MetodoPagamentoDAO = new \App\Models\MetodoPagamento\MetodoPagamentoDAO();
        $metodoPagamento = $MetodoPagamentoDAO->deleteMetodoPagamento($id);

        $this->redirect('/metodoPagamento');
    }
}
