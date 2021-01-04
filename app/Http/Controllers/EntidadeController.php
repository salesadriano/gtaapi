<?php

namespace App\Http\Controllers;

use App\Entidade;

class EntidadeController extends Controller
{

    public function __construct()
    {
        $tmp = new Entidade();
        parent::__construct($tmp);
    }

}
