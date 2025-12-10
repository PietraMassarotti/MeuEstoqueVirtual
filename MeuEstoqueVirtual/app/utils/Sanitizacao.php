<?php

namespace App\Utils;

class Sanitizacao
{
    public static function sanitizar($dado)
    {
        $dado = trim($dado);
        $dado = stripslashes($dado);
        $dado = htmlspecialchars($dado, ENT_QUOTES, 'UTF-8');
        return $dado;
    }
}
