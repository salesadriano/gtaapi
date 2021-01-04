<?php

namespace App\Http\Controllers;

use App\Estabelecimento;

class EstabelecimentoController extends Controller
{

    public function __construct()
    {
        $tmp = new Estabelecimento();
        parent::__construct($tmp);
    }

}
