<?php

namespace App\Http\Controllers;

use App\UsuarioSistema;

class UsuarioSistemaController extends Controller
{

    public function __construct()
    {
        $tmp = new UsuarioSistema();
        parent::__construct($tmp);
    }

}
