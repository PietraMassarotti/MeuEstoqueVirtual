<?php

/**
 * Controlador de Registros
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Registro\RegistroDAO;
use App\Utils\Sanitizacao;
use App\Utils\Validacao;

class RegistroController extends BaseController
{
    /**
     * Mostra a página principal de Registros
     * @return void
     */
    public function index(): void
    {
        $this->render('Registros/index');
    }

    /**
     * Mostra o formulário/página para adicionar os dados
     * @return void
     */
    public function formCreate(): void
    {
        $this->render('Registros/form_criar');
    }

    /*
    *Mostra o formulário/página para editar os dados
    */
    public function formEdit(int $id): void
    {
        $this->render('Registros/form_editar', ['id' => $id]);
    }

    /*
    *Adiciona os dados no banco 
    */
    public function create(): void
    {
        session_start();

        $quantidade = Sanitizacao::sanitizar($_POST['quantidade']);
        $acao = Sanitizacao::sanitizar($_POST['acao']);
        $descricao = Sanitizacao::sanitizar($_POST['descricao']);
        $produtos_id = Sanitizacao::sanitizar($_POST['produtos_id']);

        // Validar quantidade
        $erro = Validacao::numero($quantidade);

        if ($erro) {
            $_SESSION['mensagem'] = $erro;
            $_SESSION['tipo_mensagem'] = 'error';
            $this->redirect('/registro/adicionar');
            exit();
        }

        // Validar ação
        if (!in_array($acao, ["Entrada", "Saida"])) {
            $_SESSION['mensagem'] = "Ação inválida. Selecione Entrada ou Saida.";
            $_SESSION['tipo_mensagem'] = 'error';
            $this->redirect('/registro/adicionar');
            exit();
        }

        try {
            $registroDao = new RegistroDAO();
            $registroDao->createRegistro($quantidade, $acao, $descricao, $produtos_id);
        } catch (\Exception $e) {
            $_SESSION['mensagem'] = $e->getMessage();
            $_SESSION['tipo_mensagem'] = 'error';
            $this->redirect('/registro/adicionar');
        }

        $this->redirect('/registro');
    }

    /*
    *Edita os dados no banco
    */
    public function edit(): void
    {
        session_start();

        $id = Sanitizacao::sanitizar($_POST['id']);
        $quantidade = Sanitizacao::sanitizar($_POST['quantidade']);
        $acao = Sanitizacao::sanitizar($_POST['acao']);
        $descricao = Sanitizacao::sanitizar($_POST['descricao']);
        $produtos_id = Sanitizacao::sanitizar($_POST['produtos_id']);

        $erro = Validacao::numero($quantidade);

        if ($erro) {
            $_SESSION['mensagem'] = $erro;
            $_SESSION['tipo_mensagem'] = 'error';
            $this->redirect("/registro/editar/$id");
            exit();
        }

        $registroDao = new RegistroDAO();
        $registroDao->updateRegistro($id, $quantidade, $acao, $descricao, $produtos_id);

        $this->redirect('/registro');
    }

    /*
    * Deleta os dados no banco
    */
    public function delete(int $id): void
    {
        session_start();

        try {
            $registroDao = new RegistroDAO();
            $registroDao->deletarComAjusteEstoque($id);

        } catch (\Exception $e) {
            $_SESSION['mensagem'] = $e->getMessage();
            $_SESSION['tipo_mensagem'] = "error";
        }

        $this->redirect('/registro');
    }
}
