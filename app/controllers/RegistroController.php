<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Registro\RegistroDAO;
use App\Utils\Sanitizacao;
use App\Utils\Validacao;

class RegistroController extends BaseController
{
    /**
     * Mostra a lista de usuários
     * @return void
     */
    public function index(): void
    {
        $this->render('Registros/index');
    }

    /**
     * Mostra formulário de criação
     * @return void
     */
    public function create(): void
    {
        $registroDao =  new \App\Models\Registro\RegistroDAO();

        $quantidade = Sanitizacao::sanitizar($_POST['quantidade']);
        $acao = Sanitizacao::sanitizar($_POST['acao']);
        $descricao = Sanitizacao::sanitizar($_POST['descricao']);
        $produtos_id = Sanitizacao::sanitizar($_POST['produtos_id']);

        $erro = Validacao::numero($quantidade);
        if ($erro) {
            $_SESSION['mensagem'] = $erro;
            $this->redirect('/produto/adicionar');
            exit();
        }

        $RegistroDAO = new RegistroDAO();
        $registro = $RegistroDAO->createRegistro($quantidade, $acao, $descricao, $produtos_id);

        $this->redirect('/registro');
    }

    /**
     * Mostra formulário de edição
     * @param int $id ID do usuário
     * @return void
     */
    public function edit(): void
{
    $registroDao = new \App\Models\Registro\RegistroDAO();

    $id = Sanitizacao::sanitizar($_POST['id']);
    $quantidade = Sanitizacao::sanitizar($_POST['quantidade']);
    $acao = Sanitizacao::sanitizar($_POST['acao']); // Corrigido
    $descricao = Sanitizacao::sanitizar($_POST['descricao']);
    $produtos_id = Sanitizacao::sanitizar($_POST['produtos_id']); // Corrigido

    $registroDao->updateRegistro($id, $quantidade, $acao, $descricao, $produtos_id);

    
    $this->redirect('/registro');

}

    public function formCreate(): void
    {
        $this->render('Registros/form_criar');
    }

    public function formEdit(int $id): void
    {
        $this->render('Registros/form_editar', ['id' => $id]);
    }

    /**
     * Deleta usuário
     * @param int $id ID do usuário
     * @return void
     */
    public function delete(int $id): void
    {
        $RegistroDAO = new \App\Models\Registro\RegistroDAO();
        $registro = $RegistroDAO->deleteRegistro($id);

        $this->redirect('/registro');
    }
}
