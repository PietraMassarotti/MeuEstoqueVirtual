<?php

/**
 * Controlador de Clientes
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Utils\Sanitizacao;
use App\Utils\Validacao;

class ClienteController extends BaseController
{
    /**
     * Mostra a página principal de Clientes
     * @return void
     */
    public function index(): void
    {
        $this->render('Clientes/index');
    }

    /*
    *Mostra o formulário/página para adicionar os dados
    */
    public function formCreate(): void
    {
        $this->render('Clientes/form_criar');
    }

    /*
    *Mostra o formulário/página para editar os dados
    */
    public function formEdit(int $id): void
    {
        $this->render('Clientes/form_editar', ['id' => $id]);
    }

    /*
    *Adiciona os dados no banco 
    */
    public function create(): void
    {
        session_start();

        $nome = Sanitizacao::sanitizar($_POST['nome']);
        $email = Sanitizacao::sanitizar($_POST['email']);
        $endereco = Sanitizacao::sanitizar($_POST['endereco']);
        $telefone = Sanitizacao::sanitizar($_POST['telefone']);
        $nasc = Sanitizacao::sanitizar($_POST['nasc']);

        $erro = Validacao::validarTelefone($telefone);
        if ($erro) {
            $_SESSION['mensagem'] = $erro;
            $this->redirect('/cliente/adicionar');
            exit();
        }

        $telefone = Validacao::formatarTelefone($telefone);

        $ClienteDAO = new \App\Models\Cliente\ClienteDAO();
        $cliente = $ClienteDAO->createCliente($nome, $email, $endereco, $telefone, $nasc);

        $this->redirect('/cliente');
    }

    /*
    *Edita os dados no banco
    */
    public function edit(): void
    {
        session_start();

        $id = Sanitizacao::sanitizar($_POST['id']);
        $nome = Sanitizacao::sanitizar($_POST['nome']);
        $email = Sanitizacao::sanitizar($_POST['email']);
        $endereco = Sanitizacao::sanitizar($_POST['endereco']);
        $telefone = Sanitizacao::sanitizar($_POST['telefone']);
        $nasc = Sanitizacao::sanitizar($_POST['nasc']);

        $erro = Validacao::validarTelefone($telefone);
        if ($erro) {
            $_SESSION['mensagem'] = $erro;
            $this->redirect('/cliente/editar/' . $id);
            exit();
        }

        $telefone = Validacao::formatarTelefone($telefone);

        $ClienteDAO = new \App\Models\Cliente\ClienteDAO();
        $cliente = $ClienteDAO->updateCliente($id, $nome, $email, $endereco, $telefone, $nasc);

        $this->redirect('/cliente');
    }

    /*
    * Deleta os dados no banco
    */
    public function delete(int $id): void
    {
        session_start();

        try {
            $ClienteDAO = new \App\Models\Cliente\ClienteDAO();
            $cliente = $ClienteDAO->deleteCliente($id);

        } catch (\Exception $e) {
            // Mensagem de erro
            $_SESSION['mensagem'] = $e->getMessage();
            $_SESSION['tipo_mensagem'] = 'error';
        }

        $this->redirect('/cliente');
    }
}
