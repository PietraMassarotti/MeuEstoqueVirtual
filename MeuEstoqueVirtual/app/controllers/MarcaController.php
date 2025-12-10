<?php

/**
 * Controlador de Marcas
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Utils\Sanitizacao;

class MarcaController extends BaseController
{
    /**
     * Mostra a página principal de Marcas
     * @return void
     */
    public function index(): void
    {
        $this->render('Marcas/index');
    }

    /**
     * Mostra o formulário/página para adicionar os dados
     * @return void
     */
    public function formCreate(): void
    {
        $this->render('Marcas/form_criar');
    }

    /*
    *Mostra o formulário/página para editar os dados
    */
    public function formEdit(int $id): void
    {
        $this->render('Marcas/form_editar', ['id' => $id]);
    }

    /*
    *Adiciona os dados no banco 
    */
    public function create(): void
    {
        session_start();

        $marcaDao = new \App\Models\Marca\MarcaDAO();
        $nome = Sanitizacao::sanitizar($_POST['nome']);

        if ($marcaDao->existsByName($nome)) {
            $_SESSION['mensagem'] = "Erro: Já existe uma marca cadastrada com este nome.";
            $_SESSION['tipo_mensagem'] = "error";
            $this->redirect('/marca/adicionar');
            exit();
        }

        $marcaDao->createMarca($nome);

        $this->redirect('/marca');
    }

    /*
    *Edita os dados no banco
    */
    public function edit(): void
    {
        session_start();

        $id = Sanitizacao::sanitizar($_POST['id']);
        $nome = Sanitizacao::sanitizar($_POST['nome']);

        $marcaDao = new \App\Models\Marca\MarcaDAO();

        if ($marcaDao->existsByNameExceptId($nome, $id)) {
            $_SESSION['mensagem'] = "Erro: Já existe outra marca cadastrada com este nome.";
            $_SESSION['tipo_mensagem'] = "error";
            $this->redirect('/marca/editar/' . $id);
            exit();
        }

        $marcaDao->updateMarca($id, $nome);

        $this->redirect('/marca');
    }

    /*
    * Deleta os dados no banco
    */
    public function delete(int $id): void
    {
        session_start();

        try {
            $MarcaDAO = new \App\Models\Marca\MarcaDAO();
            $marca = $MarcaDAO->deleteMarca($id);

        } catch (\Exception $e) {
            // Mensagem de erro
            $_SESSION['mensagem'] = $e->getMessage();
            $_SESSION['tipo_mensagem'] = 'error';
        }

        $this->redirect('/marca');
    }
}
