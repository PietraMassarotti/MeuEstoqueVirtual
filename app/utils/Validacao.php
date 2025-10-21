<?php

namespace App\Utils;

class Validacao
{
    // Valida se é um número inteiro positivo (sem limite de tamanho)
    public static function numero($numero)
    {
        if (!preg_match('/^[0-9]+$/', $numero)) {
            echo "O número deve conter apenas dígitos numéricos e ser um inteiro positivo.";
            exit();
        }

        if ($numero < 0) {
            echo "O número não pode ser negativo.";
            exit();
        }

        return $numero;
    }

    public static function formatarTelefone($telefone)
    {
        // Remove tudo que não é número
        return preg_replace('/\D/', '', $telefone);
    }

    public static function validarTelefone($telefone)
    {
        $telefone = preg_replace('/\D/', '', $telefone);

        if (strlen($telefone) !== 10 && strlen($telefone) !== 11) {
            return "O telefone deve conter 10 ou 11 números";
        }

        return false; // Sem erro
    }

    public static function exibirTelefone($telefone)
    {
        // Remove tudo que não for número
        $telefone = preg_replace('/\D/', '', $telefone);

        if (strlen($telefone) === 11) {
            // (99) 99999-9999
            return preg_replace('/^(\d{2})(\d{5})(\d{4})$/', '($1) $2-$3', $telefone);
        } elseif (strlen($telefone) === 10) {
            // (99) 9999-9999
            return preg_replace('/^(\d{2})(\d{4})(\d{4})$/', '($1) $2-$3', $telefone);
        }

        // Retorna sem formatação se não tiver 10 ou 11 dígitos
        return $telefone;
    }
}
