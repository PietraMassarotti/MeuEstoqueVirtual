<?php

/**
 * Controlador de Metodos de Pagamento
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Utils\Sanitizacao;

class MetodoPagamentoController extends BaseController
{
    /**
     * Mostra a página principal de Metodos de Pagamento
     * @return void
     */
    public function index(): void
    {
        $this->render('MetodosPagamento/index');
    }

    /**
     * Mostra o formulário/página para adicionar os dados
     * @return void
     */
    public function formCreate(): void
    {
        $this->render('MetodosPagamento/form_criar');
    }

    /*
    *Mostra o formulário/página para editar os dados
    */
    public function formEdit(int $id): void
    {
        $this->render('MetodosPagamento/form_editar', ['id' => $id]);
    }

    /*
    *Adiciona os dados no banco 
    */
    public function create(): void
    {
        session_start();

        $metodoPagamentoDao = new \App\Models\MetodoPagamento\MetodoPagamentoDAO();
        $nome = Sanitizacao::sanitizar($_POST['nome']);

        if ($metodoPagamentoDao->existsByName($nome)) {
            $_SESSION['mensagem'] = "Erro: Já existe um Metodo de Pagamento cadastrado com este nome.";
            $_SESSION['tipo_mensagem'] = "error";
            $this->redirect('/metodoPagamento/adicionar');
            exit();
        }

        $MetodoPagamentoDAO = new \App\Models\MetodoPagamento\MetodoPagamentoDAO();
        $metodoPagamento = $MetodoPagamentoDAO->createMetodoPagamento($nome);

        $this->redirect('/metodoPagamento');
    }

    /*
    *Edita os dados no banco
    */
    public function edit(): void
    {

        session_start();

        $id = Sanitizacao::sanitizar($_POST['id']);
        $nome = Sanitizacao::sanitizar($_POST['nome']);

        $metodoPagamentoDao = new \App\Models\MetodoPagamento\MetodoPagamentoDAO();

        if ($metodoPagamentoDao->existsByNameExceptId($nome, $id)) {
            $_SESSION['mensagem'] = "Erro: Já existe outro Metodo de Pagamento cadastrado com este nome.";
            $_SESSION['tipo_mensagem'] = "error";
            $this->redirect('/metodoPagamento/editar/' . $id);
            exit();
        }

        $MetodoPagamentoDAO = new \App\Models\MetodoPagamento\MetodoPagamentoDAO();
        $metodoPagamento = $MetodoPagamentoDAO->updateMetodoPagamento($id, $nome);

        $this->redirect('/metodoPagamento');
    }

    /*
    * Deleta os dados no banco
    */
    public function delete(int $id): void
    {
        session_start();

        try {
            $MetodoPagamentoDAO = new \App\Models\MetodoPagamento\MetodoPagamentoDAO();
            $metodoPagamento = $MetodoPagamentoDAO->deleteMetodoPagamento($id);

        } catch (\Exception $e) {
            // Mensagem de erro
            $_SESSION['mensagem'] = $e->getMessage();
            $_SESSION['tipo_mensagem'] = 'error';
        }

        $this->redirect('/metodoPagamento');
    }
}
