<?php

/**
 * Controlador de Produtos
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Produto\ProdutoDAO;
use App\Utils\Sanitizacao;
use App\Utils\Validacao;

class ProdutoController extends BaseController
{
    /**
     * Mostra a página principal de Produtos
     * @return void
     */
    public function index(): void
    {
        $this->render('Produtos/index');
    }

    /**
     * Mostra o formulário/página para adicionar os dados
     * @return void
     */
    public function formCreate(): void
    {
        $this->render('Produtos/form_criar');
    }

    /*
    *Mostra o formulário/página para editar os dados
    */
    public function formEdit(int $id): void
    {
        $this->render('Produtos/form_editar', ['id' => $id]);
    }

    /*
    *Adiciona os dados no banco 
    */
    public function create(): void
    {
        session_start();

        $produtoDao = new \App\Models\Produto\ProdutoDAO();

        $nome = Sanitizacao::sanitizar($_POST['nome']);
        $preco = Validacao::sanitizarPreco($_POST['preco']);
        $quantidade = Sanitizacao::sanitizar($_POST['quantidade']);
        $genero = Sanitizacao::sanitizar($_POST['genero']);
        $descricao = Sanitizacao::sanitizar($_POST['descricao']);
        $data_validade = !empty($_POST['data_validade']) ? Sanitizacao::sanitizar($_POST['data_validade']) : null;
        $marcas_id = Sanitizacao::sanitizar($_POST['marcas_id']);
        $categorias_id = Sanitizacao::sanitizar($_POST['categorias_id']);

        $preco = Validacao::sanitizarPreco($_POST['preco']);

        if (!is_numeric($preco)) {
            $_SESSION['mensagem'] = $preco;
            $_SESSION['tipo_mensagem'] = 'error';
            $this->redirect('/produto/adicionar');
            exit();
        }

        $erro = Validacao::numero($quantidade);
        if ($erro) {
            $_SESSION['mensagem'] = $erro;
            $_SESSION['tipo_mensagem'] = 'error';
            $this->redirect('/produto/adicionar');
            exit();
        }

        $ProdutoDAO = new ProdutoDAO();
        $produto = $ProdutoDAO->createProduto($nome, $preco, $quantidade, $genero, $descricao, $marcas_id, $categorias_id, $data_validade);


        $this->redirect('/produto');
    }

    /*
    *Edita os dados no banco
    */
    public function edit(): void
    {
        session_start();

        $produtoDao = new \App\Models\Produto\ProdutoDAO();

        $id = Sanitizacao::sanitizar($_POST['id']);
        $nome = Sanitizacao::sanitizar($_POST['nome']);
        $preco = Validacao::sanitizarPreco($_POST['preco']);
        $quantidade = Sanitizacao::sanitizar($_POST['quantidade']);
        $genero = Sanitizacao::sanitizar($_POST['genero']);
        $descricao = Sanitizacao::sanitizar($_POST['descricao']);
        $data_validade = !empty($_POST['data_validade']) ? Sanitizacao::sanitizar($_POST['data_validade']) : null;
        $marcas_id = Sanitizacao::sanitizar($_POST['marcas_id']);
        $categorias_id = Sanitizacao::sanitizar($_POST['categorias_id']);

        $preco = Validacao::sanitizarPreco($_POST['preco']);

        if (!is_numeric($preco)) {
            $_SESSION['mensagem'] = $preco;
            $_SESSION['tipo_mensagem'] = 'error';
            $this->redirect('/produto/editar/' . $id);
            exit();
        }

        $erro = Validacao::numero($quantidade);
        if ($erro) {
            $_SESSION['mensagem'] = $erro;
            $_SESSION['tipo_mensagem'] = 'error';
            $this->redirect('/produto/editar/' . $id);
            exit();
        }

        $ProdutoDAO = new ProdutoDAO();
        $produto = $ProdutoDAO->updateProduto($id, $nome, $preco, $quantidade, $genero, $descricao, $marcas_id, $categorias_id, $data_validade);


        $this->redirect('/produto');
    }

    /*
    * Deleta os dados no banco
    */
    public function delete(int $id): void
    {
        session_start();

        try {
            $ProdutoDAO = new \App\Models\Produto\ProdutoDAO();
            $produto = $ProdutoDAO->deleteProduto($id);

            // Mensagem de sucesso
            $_SESSION['mensagem'] = 'Produto excluído com sucesso!';
            $_SESSION['tipo_mensagem'] = 'success';
        } catch (\Exception $e) {
            // Mensagem de erro
            $_SESSION['mensagem'] = $e->getMessage();
            $_SESSION['tipo_mensagem'] = 'error';
        }

        $this->redirect('/produto');
    }
}
