<?php

namespace App\Utils;

class Validacao
{
    public static function numero($numero)
    {
        if (!preg_match('/^[0-9]+$/', $numero)) {
            return "Erro: O campo 'Quantidade' deve conter apenas números inteiros.";
        }

        if ($numero < 0) {
            return "Erro: O campo 'Quantidade' não podem conter números negativos.";
        }

        return false;
    }

    public static function parcela($numero)
    {
        if (!preg_match('/^[0-9]+$/', $numero)) {
            return "Erro: O campo 'Número da Parcela' deve conter apenas números inteiros.";
        }

        if ($numero < 0) {
            return "Erro: O campo 'Número da Parcela' não podem conter números negativos.";
        }

        return false;
    }

    public static function juros($juros)
    {
        $juros = trim($juros);
        $juros = stripslashes($juros);

        if (preg_match('/[^0-9.,]/', $juros)) {
            return "Erro: O campo 'Taxa de Juros' deve conter apenas números.";
        }

        $juros = str_replace(',', '.', $juros);

        if (substr_count($juros, '.') > 1) {
            return "Erro: Valor inválido no campo 'Taxa de Juros', por favor digite novamente.";
        }

        if (!is_numeric($juros)) {
            return "Erro: O campo 'Taxa de Juros' deve conter apenas números.";
        }

        $juros = (float) $juros;

        if ($juros < 0) {
            return "Erro: O campo 'Taxa de Juros' não pode ser negativo.";
        }

        return false;
    }

    public static function formatarTelefone($telefone)
    {
        return preg_replace('/\D/', '', $telefone);
    }

    public static function validarTelefone($telefone)
    {
        $telefone = preg_replace('/\D/', '', $telefone);

        if (strlen($telefone) !== 10 && strlen($telefone) !== 11) {
            return "Erro: O campo 'Telefone' deve conter 10 ou 11 números";
        }

        return false;
    }

    public static function exibirTelefone($telefone)
    {
        $telefone = preg_replace('/\D/', '', $telefone);

        if (strlen($telefone) === 11) {
            // (99) 99999-9999
            return preg_replace('/^(\d{2})(\d{5})(\d{4})$/', '($1) $2-$3', $telefone);
        } elseif (strlen($telefone) === 10) {
            // (99) 9999-9999
            return preg_replace('/^(\d{2})(\d{4})(\d{4})$/', '($1) $2-$3', $telefone);
        }

        return $telefone;
    }

    public static function sanitizarPreco($preco)
    {
        $preco = trim($preco);
        $preco = stripslashes($preco);

        if (preg_match('/[^0-9.,]/', $preco)) {
            return "Erro: O campo 'Preço' deve conter apenas números.";
        }

        $preco = str_replace(',', '.', $preco);

        if (substr_count($preco, '.') > 1) {
            return "Erro: Valor inválido no campo 'Preço', por favor digite novamente.";
        }

        if (!is_numeric($preco)) {
            return "Erro: O campo 'Preço' deve conter apenas números.";
        }

        $preco = (float) $preco;

        if ($preco < 0) {
            return "Erro: O campo 'Preço' não pode ser negativo.";
        }

        return $preco;
    }

    public static function sanitizarValor($valor)
    {
        $valor = trim($valor);
        $valor = stripslashes($valor);

        if (preg_match('/[^0-9.,]/', $valor)) {
            return "Erro: O campo 'Valor' deve conter apenas números.";
        }

        $valor = str_replace(',', '.', $valor);

        if (substr_count($valor, '.') > 1) {
            return "Erro: Valor inválido no campo 'Valor', por favor digite novamente.";
        }

        if (!is_numeric($valor)) {
            return "Erro: O campo 'Valor' deve conter apenas números.";
        }

        $valor = (float) $valor;

        if ($valor < 0) {
            return "Erro: O campo 'Valor' não pode ser negativo.";
        }

        return $valor;
    }
}
