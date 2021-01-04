<?php

namespace App\Http\Controllers;

use App\Gta;

class GtaController extends Controller
{

    public function __construct()
    {
        $tmp = new Gta();
        parent::__construct($tmp);
    }

}
