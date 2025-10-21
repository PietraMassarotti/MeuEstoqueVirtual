<?php
/**
 * Controlador de Autenticação
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Utils\Sanitizacao;

class MarcaController extends BaseController 
{
    /**
     * Mostra a página de Marca
     * @return void
     */
    public function index(): void 
    {
        $this->render('Marcas/index');
    }

    public function create(): void 
    {

        $marcaDao = new \App\Models\Marca\MarcaDAO();
        $nome = Sanitizacao::sanitizar($_POST['nome']);

        $MarcaDAO = new \App\Models\Marca\MarcaDAO();
        $marca = $MarcaDAO->createMarca($nome);

        $this->redirect('/marca');
    }

    public function edit(): void 
    {
        $id = Sanitizacao::sanitizar($_POST['id']);
        $nome = Sanitizacao::sanitizar($_POST['nome']);

        $MarcaDAO = new \App\Models\Marca\MarcaDAO();
        $marca = $MarcaDAO->updateMarca($id, $nome);

        $this->redirect('/marca');
    }

    public function save(): void 
    {
        $this->render('Marcas/index');
    }

    public function delete(): void 
    {
        $id = Sanitizacao::sanitizar($_GET['id']);

        $MarcaDAO = new \App\Models\Marca\MarcaDAO();
        $marca = $MarcaDAO->deleteMarca($id);

        $this->redirect('/marca');
    }
    
}
?>