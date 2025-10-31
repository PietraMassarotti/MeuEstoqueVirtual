<?php

declare(strict_types=1);

namespace App\Controllers;

class BaseController
{
    /**
     * @param string 
     * @param array 
     * @return void
     */
    protected function render(string $view, array $data = []): void
    {
        extract($data);
        $viewPath = __DIR__ . '/../views/pages/' . $view . '.php';
        $layoutPath = __DIR__ . '/../views/layouts/Menu/index.php';

        if (file_exists($viewPath)) {
            ob_start();
            $content = ob_get_clean();
            if ($view == 'Login/index') {
                include $viewPath;
            } else {
                include $layoutPath;
                include $viewPath;
            }
        } else {
            die("View não encontrada: " . $viewPath);
        }
    }

    /**
     * @param string 
     * @return void
     */
    protected function redirect(string $url): void
    {
        $basePath = '/MeuEstoqueVirtual/public';

        header("Location: " . $basePath . $url);
        exit();
    }

    /**
     * @param string
     * @param array
     * @return void
     */
    public function renderView(string $view, array $data = []): void
    {
        $this->render($view, $data);
    }
}
