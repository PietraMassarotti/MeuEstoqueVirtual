<?php

/**
 * Controlador de Autenticação
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Utils\Sanitizacao;

class CategoriaController extends BaseController
{
    /**
     * Mostra a página de Marca
     * @return void
     */
    public function index(): void
    {
        $this->render('Categorias/index');
    }

      /**
     * Mostra formulário de criação
     * @return void
     */
    public function create(): void
    {
        $categoriaDao = new \App\Models\Categoria\CategoriaDAO();
        $nome = Sanitizacao::sanitizar($_POST['nome']);

        $CategoriaDAO = new \App\Models\Categoria\CategoriaDAO();
        $categoria = $CategoriaDAO->createCategoria($nome);

        $this->redirect('/categoria');
    }

    public function edit(): void
    {
        $id = Sanitizacao::sanitizar($_POST['id']);
        $nome = Sanitizacao::sanitizar($_POST['nome']);

        $CategoriaDAO = new \App\Models\Categoria\CategoriaDAO();
        $categoria = $CategoriaDAO->updateCategoria($id, $nome);

        $this->redirect('/categoria');
    }

    public function formCreate(): void
    {
        $this->render('Categorias/form_criar');
    }

    public function formEdit(int $id): void
    {
        $this->render('Categorias/form_editar', ['id' => $id]);
    }

    public function delete(int $id): void
    {   
        $CategoriaDAO = new \App\Models\Categoria\CategoriaDAO();
        $categoria = $CategoriaDAO->deleteCategoria($id);
       
        $this->redirect('/categoria');
    }
}
