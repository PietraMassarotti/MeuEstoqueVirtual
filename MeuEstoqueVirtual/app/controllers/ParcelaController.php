<?php

/**
 * Controlador de Parcelas
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Parcela\ParcelaDAO;
use App\Utils\Sanitizacao;
use App\Utils\Validacao;

class ParcelaController extends BaseController
{
    /**
     * Mostra a página principal de Parcelas
     */
    public function index(): void
    {
        $this->render('Parcelas/index');
    }

    /**
     * Mostra o formulário de criação
     */
    public function formCreate(): void
    {
        $this->render('Parcelas/form_criar');
    }

    /**
     * Mostra formulário de edição
     */
    public function formEdit(int $id): void
    {
        $this->render('Parcelas/form_editar', ['id' => $id]);
    }

    /*
    * Adiciona os dados no banco 
    */
    public function create(): void
    {
        session_start();

        $numero = Sanitizacao::sanitizar($_POST['numero']);
        $valor  = Sanitizacao::sanitizar($_POST['valor']);
        $data   = Sanitizacao::sanitizar($_POST['data']);
        $status = Sanitizacao::sanitizar($_POST['status']);
        $compras_id = Sanitizacao::sanitizar($_POST['compras_id']);

        $erro = Validacao::parcela($numero);
        if ($erro) {
            $_SESSION['mensagem'] = $erro;
            $_SESSION['tipo_mensagem'] = 'error';
            $this->redirect('/parcela/adicionar');
            exit();
        }

        $valorSanitizado = Validacao::sanitizarValor($valor);
        if (!is_numeric($valorSanitizado)) {
            $_SESSION['mensagem'] = $valorSanitizado;
            $_SESSION['tipo_mensagem'] = 'error';
            $this->redirect('/parcela/adicionar');
            exit();
        }

        $parcelaDAO = new ParcelaDAO();
        $parcelaDAO->createParcela($numero, $valorSanitizado, $data, $status, $compras_id);

        $this->redirect('/parcela');
    }

    /*
    * Edita os dados no banco
    */
    public function edit(): void
    {
        session_start();

        $id = Sanitizacao::sanitizar($_POST['id']);
        $numero = Sanitizacao::sanitizar($_POST['numero']);
        $valor  = Sanitizacao::sanitizar($_POST['valor']);
        $data   = Sanitizacao::sanitizar($_POST['data']);
        $status = Sanitizacao::sanitizar($_POST['status']);
        $compras_id = Sanitizacao::sanitizar($_POST['compras_id']);

        $erro = Validacao::parcela($numero);
        if ($erro) {
            $_SESSION['mensagem'] = $erro;
            $_SESSION['tipo_mensagem'] = 'error';
            $this->redirect("/parcela/editar/$id");
            exit();
        }

        $valorSanitizado = Validacao::sanitizarValor($valor);
        if (!is_numeric($valorSanitizado)) {
            $_SESSION['mensagem'] = $valorSanitizado;
            $_SESSION['tipo_mensagem'] = 'error';
            $this->redirect("/parcela/editar/$id");
            exit();
        }

        $parcelaDAO = new ParcelaDAO();
        $parcelaDAO->updateParcela($id, $numero, $valorSanitizado, $data, $status, $compras_id);

        $this->redirect('/parcela');
    }

    /*
    * Deleta os dados no banco
    */
    public function delete(int $id): void
    {
        session_start();

        $parcelaDAO = new ParcelaDAO();
        $parcelaDAO->deleteParcela($id);

        $this->redirect('/parcela');
    }
}
