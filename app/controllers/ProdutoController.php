<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Produto\ProdutoDAO;
use App\Utils\Sanitizacao;
use App\Utils\Validacao;

class ProdutoController extends BaseController
{
    /**
     * Mostra a lista de usuários
     * @return void
     */
    public function index(): void
    {
        $this->render('Produtos/index');
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

        $erro = Validacao::numero($quantidade);
        if ($erro) {
            $_SESSION['mensagem'] = $erro;
            $this->redirect('/produto/adicionar');
            exit();
        }

        $ProdutoDAO = new ProdutoDAO();
        $produto = $ProdutoDAO->createProduto($nome, $preco, $quantidade, $genero, $descricao, $marcas_id, $categorias_id);

        $this->redirect('/produto');
    }

    /**
     * Mostra formulário de edição
     * @param int $id ID do usuário
     * @return void
     */
    public function edit(): void
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

        $this->redirect('/produto');
    }

    public function formCreate(): void
    {
        $this->render('Produtos/form_criar');
    }

    public function formEdit(int $id): void
    {
        $this->render('Produtos/form_editar', ['id' => $id]);
    }

    /**
     * Deleta usuário
     * @param int $id ID do usuário
     * @return void
     */
    public function delete(int $id): void
    {
        $ProdutoDAO = new \App\Models\Produto\ProdutoDAO();
        $produto = $ProdutoDAO->deleteProduto($id);

        $this->redirect('/produto');
    }
}
