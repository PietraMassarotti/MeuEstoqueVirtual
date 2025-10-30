<?php
/**
 * Autoloader PSR-4
 * Carrega automaticamente as classes com base nos namespaces
 */

declare(strict_types=1);

spl_autoload_register(function ($class) {
    // Mapeamento de namespaces para diretórios
    $prefixes = [
        'App\\' => __DIR__ . '/../app/',
        'Config\\' => __DIR__ . '/../config/'
    ];

    // Verificar cada prefixo
    foreach ($prefixes as $prefix => $baseDir) {
        // Verificar se a classe usa este prefixo
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            continue;
        }

        // Obter o caminho relativo da classe
        $relativeClass = substr($class, $len);

        // Substituir separadores de namespace por separadores de diretório
        $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

        // Se o arquivo existir, incluí-lo
        if (file_exists($file)) {
            require $file;
            return;
        }
    }
});
?>