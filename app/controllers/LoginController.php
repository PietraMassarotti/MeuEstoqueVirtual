<?php
/**
 * Controlador de Autenticação
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Utils\Sanitizacao;

class LoginController extends BaseController 
{
    /**
     * Mostra a página de login
     * @return void
     */
    public function showLogin(): void 
    {
        $this->render('Login/index');
    }
    
    /**
     * Processa o login
     * @return void
     */
    public function login(): void 
    {
        // Sanitiza as entradas
        $email = Sanitizacao::sanitizar($_POST['email']);
        $senha = Sanitizacao::sanitizar($_POST['senha']);
        // Valida o login
        $adminDAO = new \App\Models\Admin\AdminDAO();
        $admin = $adminDAO->validarLogin($email, $senha);

        if ($admin) {
            session_start();
            $_SESSION['logado'] = true;
            $_SESSION['admin'] = [
                "id" => $admin->getId()
            ];
            $this->redirect('/produto');
        } else {
            echo "Email ou senha incorretos :(";
        }

        
    }
    
    /**
     * Faz logout
     * @return void
     */
    public function logout(): void 
    {
        session_start();
        session_destroy();
        $this->redirect('/');
        exit();
    }
}
?>