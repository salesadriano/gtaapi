<?php

namespace App\Http\Controllers;

use App\Entidade;
use Illuminate\Http\Request;

class EntidadeController extends Controller
{

    public function __construct()
    {
        $tmp = new Entidade();
        parent::__construct($tmp);
    }

    /**
     * @hideFromAPIDocumentation
     *
     */
    public function mostrar(Request $request, String $campos = '', Bool $completo = true)
    {
        return parent::mostrar($request, $campos, $completo);
    }

}
