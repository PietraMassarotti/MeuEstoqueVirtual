<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Parcelamento\ParcelamentoDAO;
use App\Utils\Sanitizacao;
use App\Utils\Validacao;

class ParcelamentoController extends BaseController
{
    /**
     * Mostra a lista de usuários
     * @return void
     */
    public function index(): void
    {
        $this->render('Parcelamentos/index');
    }

    /**
     * Mostra formulário de criação
     * @return void
     */
    public function create(): void
    {

        $quantidade = Sanitizacao::sanitizar($_POST['quantidade']);
        $taxa_juros = Sanitizacao::sanitizar($_POST['taxa_juros']);
        $metodos_pagamento_id = Sanitizacao::sanitizar($_POST['metodos_pagamento_id']);

        $erro = Validacao::numero($quantidade);
        if ($erro) {
            $_SESSION['mensagem'] = $erro;
            $this->redirect('/parcelamento/adicionar');
            exit();
        }

        $ParcelamentoDAO = new ParcelamentoDAO();
        $parcelamento = $ParcelamentoDAO->createParcelamento($quantidade, $taxa_juros, $metodos_pagamento_id);

        $this->redirect('/parcelamento');
    }

    /**
     * Mostra formulário de edição
     * @param int $id ID do usuário
     * @return void
     */
    public function edit(): void
    {
        $id = Sanitizacao::sanitizar($_POST['id']);
        $quantidade = Sanitizacao::sanitizar($_POST['quantidade']);
        $taxa_juros = Sanitizacao::sanitizar($_POST['taxa_juros']);
        $metodos_pagamento_id = Sanitizacao::sanitizar($_POST['metodos_pagamento_id']);

        $ParcelamentoDAO = new ParcelamentoDAO();
        $parcelamento = $ParcelamentoDAO->updateParcelamento($id, $quantidade, $taxa_juros, $metodos_pagamento_id);

        $this->redirect('/parcelamento');
    }

    public function formCreate(): void
    {
        $this->render('Parcelamentos/form_criar');
    }

    public function formEdit(int $id): void
    {
        $this->render('Parcelamentos/form_editar', ['id' => $id]);
    }

    /**
     * Deleta usuário
     * @param int $id ID do usuário
     * @return void
     */
    public function delete(int $id): void
    {
        $ParcelamentoDAO = new \App\Models\Parcelamento\ParcelamentoDAO();
        $parcelamento = $ParcelamentoDAO->deleteParcelamento($id);

        $this->redirect('/parcelamento');
    }
}
