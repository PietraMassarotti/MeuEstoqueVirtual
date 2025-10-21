<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Produto\ProdutoDAO;
use App\Utils\Sanitizacao;
use App\Utils\SenhaValidacao;

class ProdutoController extends BaseController
{
    /**
     * Mostra a lista de usuários
     * @return void
     */
    public function index(): void
    {
        $this->render('cadastro');
    }

    /**
     * Mostra formulário de criação
     * @return void
     */
    public function create(): void
    {
        $produtoDao =  new \App\Models\Produto\ProdutoDAO();

        $nome = Sanitizacao::sanitizar($_POST['nome']);
        $preco = Sanitizacao::sanitizar($_POST['preco']);
        $quantidade = Sanitizacao::sanitizar($_POST['quantidade']);
        $genero = Sanitizacao::sanitizar($_POST['genero']);
        $descricao = Sanitizacao::sanitizar($_POST['descricao']);
        $marcas_id = Sanitizacao::sanitizar($_POST['marcas_id']);
        $categorias_id = Sanitizacao::sanitizar($_POST['categorias_id']);

        $ProdutoDAO = new ProdutoDAO();
        $produto = $ProdutoDAO->createProduto($nome, $preco, $quantidade, $genero, $descricao, $marcas_id, $categorias_id);

        $this->redirect('/marca');
    }

    /**
     * Mostra formulário de edição
     * @param int $id ID do usuário
     * @return void
     */
    public function edit(int $id): void
    {
        $produtoDao = new \App\Models\Produto\ProdutoDAO();
        $id = Sanitizacao::sanitizar($_POST['id']);
        $nome = Sanitizacao::sanitizar($_POST['nome']);
        $preco = Sanitizacao::sanitizar($_POST['preco']);
        $quantidade = Sanitizacao::sanitizar($_POST['quantidade']);
        $genero = Sanitizacao::sanitizar($_POST['genero']);
        $descricao = Sanitizacao::sanitizar($_POST['descricao']);
        $marcas_id = Sanitizacao::sanitizar($_POST['marcas_id']);
        $categorias_id = Sanitizacao::sanitizar($_POST['categorias_id']);

        $ProdutoDAO = new ProdutoDAO();
        $produto = $ProdutoDAO->updateProduto($id, $nome, $preco, $quantidade, $genero, $descricao, $marcas_id, $categorias_id);

        $this->redirect('/marca');
    }

    /**
     * Salva usuário (criar ou atualizar)
     * @return void
     */
    public function save(): void
    {
        $this->render('Produtos/save');
    }

    /**
     * Deleta usuário
     * @param int $id ID do usuário
     * @return void
     */
    public function delete(int $id): void
    {
        session_start();
        $id = Sanitizacao::sanitizar($_GET['id']);

        $ProdutoDAO =new \App\Models\Produto\ProdutoDAO();
        $produto = $ProdutoDAO->deleteProduto($id);

        $this->redirect('/marca');
    }
}
