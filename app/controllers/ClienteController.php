<?php

/**
 * Controlador de Autenticação
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Utils\Sanitizacao;
use App\Utils\Validacao;

class ClienteController extends BaseController
{
    /**
     * Mostra a página de Marca
     * @return void
     */
    public function index(): void
    {
        $this->render('Clientes/index');
    }

    public function create(): void
    {
        session_start();

        $nome = Sanitizacao::sanitizar($_POST['nome']);
        $email = Sanitizacao::sanitizar($_POST['email']);
        $endereco = Sanitizacao::sanitizar($_POST['endereco']);
        $telefone = Sanitizacao::sanitizar($_POST['telefone']);
        $nasc = Sanitizacao::sanitizar($_POST['nasc']);

        $erroTelefone = Validacao::validarTelefone($telefone);
        if ($erroTelefone) {
            $_SESSION['mensagem'] = $erroTelefone;
            $this->redirect('/cliente/adicionar');
            exit();
        }

        $telefone = Validacao::formatarTelefone($telefone);

        $ClienteDAO = new \App\Models\Cliente\ClienteDAO();
        $cliente = $ClienteDAO->createCliente($nome, $email, $endereco, $telefone, $nasc);

        $this->redirect('/cliente');
    }

    public function formCreate(): void
    {
        $this->render('Clientes/form_criar');
    }

    public function edit(): void
    {
        session_start();

        $id = Sanitizacao::sanitizar($_POST['id']);
        $nome = Sanitizacao::sanitizar($_POST['nome']);
        $email = Sanitizacao::sanitizar($_POST['email']);
        $endereco = Sanitizacao::sanitizar($_POST['endereco']);
        $telefone = Sanitizacao::sanitizar($_POST['telefone']);
        $nasc = Sanitizacao::sanitizar($_POST['nasc']);

        $erroTelefone = Validacao::validarTelefone($telefone);
        if ($erroTelefone) {
            $_SESSION['mensagem'] = $erroTelefone;
            $this->redirect('/cliente/editar/' . $id);
            exit();
        }

        $telefone = Validacao::formatarTelefone($telefone);

        $ClienteDAO = new \App\Models\Cliente\ClienteDAO();
        $cliente = $ClienteDAO->updateCliente($id, $nome, $email, $endereco, $telefone, $nasc);

        $this->redirect('/cliente');
    }

    public function formEdit(int $id): void
    {
        $this->render('Clientes/form_editar', ['id' => $id]);
    }

    public function delete(int $id): void
    {
        $ClienteDAO = new \App\Models\Cliente\ClienteDAO();
        $cliente = $ClienteDAO->deleteCliente($id);

        $this->redirect('/cliente');
    }
}
