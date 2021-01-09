<?php

namespace App\Http\Controllers;

use App\Estabelecimento;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @group Estabelecimento
 *
 */
class EstabelecimentoController extends Controller
{

    public function __construct()
    {
        $tmp = new Estabelecimento();
        parent::__construct($tmp);
    }

    /**
     * Dados dos Estabelecimento
     *
     * <aside class="notice">Retorna o conjunto de dados dos estabelecimento e as GTAs emitidas em favor deles.</aside>
     *
     * @queryParam municipio string required <b>Nome do Municipio</b>
     * @queryParam ano integer required <b>Ano de emissão das GTAs</b>
     * @queryParam UF string Sigla do Estado
     * @queryParam nomUF string Nome do Estado
     * @queryParam completo boolean Determina se as GTAs serão retornadas
     * @queryParam registrosPagina integer Numero de registros em cada página da lista
     * @queryParam pagina integer Pagina da lista a ser apresentada
     *
     * @responseField id integer ID do registro no bando de dados
     * @responseField codUF integer Codigo do municipio no IBGE
     * @responseField UF string Sigla do Estado
     * @responseField nomUF string Nome do Estado
     * @responseField codMunicipio integer Codigo do municipio no IBGE
     * @responseField municipio string Nome do municipio
     * @responseField latitude number Latitude do estabelecimento
     * @responseField longitude number Longitude do estabelecimento
     * @responseField tipoDeEstabelecimento string Tipo de Estabelecimento
     * @responseField GTAs GTA[] GTAs associadas ao Estabelecimento
     * @responseField ano integer Ano de emissão das GTAs
     *
     * @response 200 {
     * 'id':0,
     * 'codUF': 12,
     * 'UF': 'AC',
     * 'nomUF': 'Acre',
     * 'codMunicipio': 120212,
     * 'municipio': 'Rio Branco',
     * 'latitude': 1.23123,
     * 'longitude': 1.123123,
     * 'tipoDeEstabelecimento': 'Fazenda',
     * 'GTAs': ['GTAs'],
     * 'ano': 2020}
     *
     * @group Estabelecimento
     * @authenticated
     *
     */
    public function mostrar(Request $request, String $campos = '', Bool $completo = true)
    {
        if (!$request->input('municipio')) {return response()->json(["Erro" => "O municipio deve ser informado"], Response::HTTP_BAD_REQUEST);}
        if (!$request->input('ano')) {return response()->json(["Erro" => "O ano deve ser informado"], Response::HTTP_BAD_REQUEST);}
        return parent::mostrar($request, $campos, $completo);

    }

}
