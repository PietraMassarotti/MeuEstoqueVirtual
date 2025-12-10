<?php

/**
 * Controlador de Parcelamentos
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Parcelamento\ParcelamentoDAO;
use App\Utils\Sanitizacao;
use App\Utils\Validacao;

class ParcelamentoController extends BaseController
{
    /**
     * Mostra a página principal de Parcelamentos
     * @return void
     */
    public function index(): void
    {
        $this->render('Parcelamentos/index');
    }

    /**
     * Mostra o formulário/página para adicionar os dados
     * @return void
     */
    public function formCreate(): void
    {
        $this->render('Parcelamentos/form_criar');
    }

    /*
    *Mostra o formulário/página para editar os dados
    */
    public function formEdit(int $id): void
    {
        $this->render('Parcelamentos/form_editar', ['id' => $id]);
    }

    /*
    *Adiciona os dados no banco 
    */
    public function create(): void
    {
        session_start();

        $quantidade = Sanitizacao::sanitizar($_POST['quantidade']);
        $taxa_juros = Sanitizacao::sanitizar($_POST['taxa_juros']);
        $metodos_pagamento_id = Sanitizacao::sanitizar($_POST['metodos_pagamento_id']);

        // Converte vírgula para ponto
        $taxa_juros = str_replace(',', '.', $taxa_juros);


        $erro = Validacao::numero($quantidade);
        if ($erro) {
            $_SESSION['mensagem'] = $erro;
            $_SESSION['tipo_mensagem'] = 'error';
            $this->redirect('/parcelamento/adicionar');
            exit();
        }

        $erro = Validacao::juros($taxa_juros);
        if ($erro) {
            $_SESSION['mensagem'] = $erro;
            $_SESSION['tipo_mensagem'] = 'error';
            $this->redirect('/parcelamento/adicionar');
            exit();
        }

        $ParcelamentoDAO = new ParcelamentoDAO();
        $ParcelamentoDAO->createParcelamento($quantidade, $taxa_juros, $metodos_pagamento_id);

        $this->redirect('/parcelamento');
    }

    /*
    *Edita os dados no banco
    */
    public function edit(): void
    {
        session_start();

        $id = Sanitizacao::sanitizar($_POST['id']);
        $quantidade = Sanitizacao::sanitizar($_POST['quantidade']);
        $taxa_juros = Sanitizacao::sanitizar($_POST['taxa_juros']);
        $metodos_pagamento_id = Sanitizacao::sanitizar($_POST['metodos_pagamento_id']);

        $taxa_juros = str_replace(',', '.', $taxa_juros);

        $erro = Validacao::numero($quantidade);
        if ($erro) {
            $_SESSION['mensagem'] = $erro;
            $_SESSION['tipo_mensagem'] = 'error';
            $this->redirect('/parcelamento/editar/' . $id);
            exit();
        }

        $erro = Validacao::juros($taxa_juros);
        if ($erro) {
            $_SESSION['mensagem'] = $erro;
            $_SESSION['tipo_mensagem'] = 'error';
            $this->redirect('/parcelamento/editar/' . $id);
            exit();
        }

        $ParcelamentoDAO = new ParcelamentoDAO();
        $ParcelamentoDAO->updateParcelamento($id, $quantidade, $taxa_juros, $metodos_pagamento_id);

        $this->redirect('/parcelamento');
    }

    /*
    * Deleta os dados no banco
    */
    public function delete(int $id): void
    {
        session_start();

        try {
            $ParcelamentoDAO = new ParcelamentoDAO();
            $ParcelamentoDAO->deleteParcelamento($id);
        } catch (\Exception $e) {

            // Mensagem de erro
            $_SESSION['mensagem'] = $e->getMessage();
            $_SESSION['tipo_mensagem'] = 'error';
        }

        $this->redirect('/parcelamento');
    }
}
