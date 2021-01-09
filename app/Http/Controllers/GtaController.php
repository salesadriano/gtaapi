<?php

namespace App\Http\Controllers;

use App\Gta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * * @group GTA
 */
class GtaController extends Controller
{

    public function __construct()
    {
        $tmp = new Gta();
        parent::__construct($tmp);
    }

/**
 * Dados das GTAs
 *
 * <aside class="notice">Retorna o conjunto de GTAs emitidas.</aside>
 *
 * @queryParam ano integer required <b>Ano de emissão das GTAs</b>
 * @queryParam mes string Mes de emissão das GTAs
 * @queryParam finalidade string Nome do Estado
 * @queryParam especie string Nome do Estado
 * @queryParam registrosPagina integer Numero de registros em cada página da lista
 * @queryParam pagina integer Pagina da lista a ser apresentada
 *
 * @responseField numGTA integer .
 * @responseField serieGTA string .
 * @responseField dataHoraEmissao date .
 * @responseField ano integer .
 * @responseField mes integer .
 * @responseField tipoDeTransporte string .
 * @responseField finalidade string .
 * @responseField especie string .
 * @responseField orig_Id integer .
 * @responseField dest_Id integer .
 * @responseField orig_Tipo string .
 * @responseField dest_Tipo string .
 * @responseField bovTotal integer .
 * @responseField bovMacho integer .
 * @responseField bovFemea integer .
 * @responseField bov0a12Macho integer .
 * @responseField bov0a12Femea integer .
 * @responseField bov13a24Macho integer .
 * @responseField bov13a24Femea integer .
 * @responseField bov25a36Macho integer .
 * @responseField bov25a36Femea integer .
 * @responseField bovmais36Macho integer .
 * @responseField bovmais36Femea integer .
 *
 * @response 200 {
 * "numGTA": "604708",
 *    "serieGTA": "D",
 *    "dataHoraEmissao": "2019-01-02",
 *    "ano": "2019",
 *    "mes": "1",
 *    "tipoDeTransporte": "RODOVIÁRIO",
 *    "finalidade": "Abate",
 *    "especie": "BOVINOS",
 *    "orig_Id": "16621",
 *    "dest_Id": "10399",
 *    "orig_Tipo": "Propriedade",
 *    "dest_Tipo": "Agroindustria",
 *    "bovTotal": "6",
 *    "bovMacho": "6",
 *    "bovFemea": "0",
 *    "bov0a12Macho": "0",
 *    "bov0a12Femea": "0",
 *    "bov13a24Macho": "0",
 *    "bov13a24Femea": "0",
 *    "bov25a36Macho": "0",
 *    "bov25a36Femea": "0",
 *    "bovmais36Macho": "6",
 *    "bovmais36Femea": "0"
 *  }
 *
 * @group GTA
 * @authenticated
 *
 */

    public function mostrar(Request $request, String $campos = '', Bool $completo = true)
    {
        if (!$request->input('ano')) {return response()->json(["Erro" => "O ano deve ser informado"], Response::HTTP_BAD_REQUEST);}
        return parent::mostrar($request, $campos, $completo);
    }

}
