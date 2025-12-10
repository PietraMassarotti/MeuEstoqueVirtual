<?php

/**
 * Controlador de Categorias
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Utils\Sanitizacao;

class CategoriaController extends BaseController
{
    /**
     * Mostra a página de principal de Categorias
     * @return void
     */
    public function index(): void
    {
        $this->render('Categorias/index');
    }

    /*
    *Mostra o formulário/página para adicionar os dados
    */
    public function formCreate(): void
    {
        $this->render('Categorias/form_criar');
    }

    /*
    *Mostra o formulário/página para editar os dados
    */
    public function formEdit(int $id): void
    {
        $this->render('Categorias/form_editar', ['id' => $id]);
    }

    /**
     * Adiciona os dados no banco
     * @return void
     */
    public function create(): void
    {
        session_start();

        $categoriaDao = new \App\Models\Categoria\CategoriaDAO();
        $nome = Sanitizacao::sanitizar($_POST['nome']);

        if ($categoriaDao->existsByName($nome)) {
            $_SESSION['mensagem'] = "Erro: Já existe uma categoria cadastrada com este nome.";
            $_SESSION['tipo_mensagem'] = "error";
            $this->redirect('/categoria/adicionar');
            exit();
        }

        $categoriaDao->createCategoria($nome);

        $this->redirect('/categoria');
    }

    /*
    *Edita os dados no banco
    */
    public function edit(): void
    {
        session_start();

        $id = Sanitizacao::sanitizar($_POST['id']);
        $nome = Sanitizacao::sanitizar($_POST['nome']);

        $categoriaDao = new \App\Models\Categoria\CategoriaDAO();

        // 🔥 Verifica nome duplicado (exceto o próprio registro)
        if ($categoriaDao->existsByNameExceptId($nome, $id)) {
            $_SESSION['mensagem'] = "Erro: Já existe outra categoria com este nome.";
            $_SESSION['tipo_mensagem'] = "error";
            $this->redirect('/categoria/editar/' . $id);
            exit();
        }

        $categoriaDao->updateCategoria($id, $nome);

        $this->redirect('/categoria');
    }

    /*
    * Deleta os dados no banco
    */
    public function delete(int $id): void
    {
        session_start();
        
        try {
            $CategoriaDAO = new \App\Models\Categoria\CategoriaDAO();
            $categoria = $CategoriaDAO->deleteCategoria($id);
        } catch (\Exception $e) {
            // Capturar erro e redirecionar com mensagem
            $_SESSION['mensagem'] = $e->getMessage();
            $_SESSION['tipo_mensagem'] = 'error';
        }

        $this->redirect('/categoria');
    }
}
