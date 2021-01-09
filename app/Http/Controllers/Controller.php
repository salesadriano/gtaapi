<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\VCard;

// TODO Especializar as Expitions
class Controller extends BaseController
{

    /**
     * Classe base modelo.
     */
    protected $classe;
    /**
     * Representa a classe que herdou os atributos e métodos do modelo
     *
     * @var Class
     */
    private $nomeClasse;

    /**
     * construtor da classe
     *
     * @param Modelo $classe
     * @param Bool $autenticado
     *
     */
    public function __construct(Model &$classe, Bool $autenticado = true, Array $authExcept = [])
    {

     $this->classe = $classe;

     //Verifica se o middlware foi fornecido na classe filha

    // TODO Ajustar QRCode
    //$authExcept[] = 'login';
    $authExcept[] = 'lerQRCode';

    if (empty($this->middleware)) {
        $this->middleware('jwt.auth', ['except' => $authExcept]);
    }

     $this->nomeClasse = get_class($classe);

    }

    /**
     * Retorna lista de registros cadastrados
     *
     * @param Request $request - Parâmetros de busca
     * @param String $campos - Lista de campos para filtro
     * @param Bool $name Bool $completo - indica se serão retornados os objetos dependentes
     * @return Json
     *
     */
    public function mostrar(Request $request , String $campos = '', Bool $completo = true)
    {
     try {
      if (count($request->all())) {
       if ($request->has('completo')) {
        $completo = filter_var($request->input('completo'), FILTER_VALIDATE_BOOLEAN);
       }

       $parametro = null;
       if (count($request->all()) == 1 && $request->has('filtro')) {
        $tabela = $this->classe->getTable();
        $strparametro = '';
        $temParam = false;
        $filtro = $request->input('filtro');
        $parametros_banco = $this->classe->retornaParametros();
        foreach ($parametros_banco as $parametro_banco) {
         $nome = $parametro_banco->name;
         if ($nome == 'criterio') {
          $temParam = true;
         }

         if (is_numeric(strpos($campos, $nome))) {
          switch ($parametro_banco->tipo) {
           case 'date':
           case 'datetime':
           case 'numeric':
           case 'int':
            if (is_numeric($filtro)) {
             $strparametro .= "$tabela.$nome = $filtro or ";
             break;
            }
           default:
            $strparametro .= "$tabela.$nome like ''%$filtro%'' or ";
          }
         }
        }

        if (strlen($strparametro) > 0 && $temParam) {
         $strparametro = substr($strparametro, 0, strlen($strparametro) - 3);
         $parametro = ['criterio' => $strparametro];
        }
       } else {
        $parametro = $request->all();
       }

       $classes = $this->classe->buscar($parametro, $completo);
      } else {
       $classes = $this->classe->buscar([], $completo);
      }
      if ($classes) {
       return response()->json($classes, Response::HTTP_OK);
      } else {
       return response()->json([], Response::HTTP_OK);
      }
     } catch (\Exception $e) {
      return response()->json([$e->getMessage()], Response::HTTP_UNAUTHORIZED);
     }
    }

    /**
     * Retorna lista de registros cadastrados
     *
     * @param Request $request - Parâmetros de busca
     * @param String $campos - Lista de campos para filtro
     * @return Json
     *
     */
    public function mostrarResumido(request $request, String $campos = '')
    {
     try {
      if (count($request->all())) {
       $parametro = null;
       if (count($request->all()) == 1 && $request->has('filtro')) {
        $tabela = $this->classe->getTable();
        $strparametro = '';
        $temParam = false;
        $filtro = $request->input('filtro');
        $parametros_banco = $this->classe->retornaParametros();
        foreach ($parametros_banco as $parametro_banco) {
         $nome = $parametro_banco->name;
         if ($nome == 'criterio') {
          $temParam = true;
         }

         if (is_numeric(strpos($campos, $nome))) {
          switch ($parametro_banco->tipo) {
           case 'date':
           case 'datetime':
           case 'numeric':
           case 'int':
            if (is_numeric($filtro)) {
             $strparametro .= "$tabela.$nome = $filtro or ";
             break;
            }
           default:
            $strparametro .= "$tabela.$nome like ''%$filtro%'' or ";
          }
         }
        }

        if (strlen($strparametro) > 0 && $temParam) {
         $strparametro = substr($strparametro, 0, strlen($strparametro) - 3);
         $parametro = ['criterio' => $strparametro];
        }
       } else {
        $parametro = $request->all();
       }

       $classes = $this->classe->buscarResumido($parametro);
      } else {
       $classes = $this->classe->buscarResumido();
      }
      if ($classes) {
       return response()->json($classes, Response::HTTP_OK);
      } else {
       return response()->json([], Response::HTTP_OK);
      }
     } catch (\Exception $e) {
      return response()->json([$e->getMessage()], Response::HTTP_UNAUTHORIZED);
     }
    }

    /**
     * Persiste os dados da tela
     *
     * @param Request $request - dados a serem persistidos
     * @return Json
     *
     */
    public function salvar(Request $request)
    {
     try {
      $this->validar($request);
      $tmp = $this->classe->completo;
      $this->classe->completo = false;
      $this->classe->definir((array) $request->all());
      $this->classe->completo = $tmp;
      $this->classe->salvar();
      $pk = $this->classe->getKeyName();
      $classe = $this->classe->buscar([$pk => $this->classe->getAttributeValue($pk)])[0];
      return response()->json($classe, Response::HTTP_CREATED);
     } catch (\Exception $e) {
      return response()->json([$e->getMessage()], Response::HTTP_UNAUTHORIZED);
     }
    }

    /**
     * Undocumented function
     *
     * @param Array $array
     * @param String $classe
     * @param String $foreignKey
     * @return Json
     */
    public function salvarFilhos(array $array = null, String $classe = null, String $foreignKey = null)
    {

     try {
      if (!is_null($array) && !is_null($classe)) {
       foreach ($array as $elemento) {
        $tmp = new $classe([], false);
        if (is_null($foreignKey)) {
         $foreignKey = $this->classe->getKeyName();
        }

        $elemento[$foreignKey] = $this->classe->getAttributeValue($foreignKey);
        $tmp->definir($elemento);
        $tmp->salvar();
       }
      }
      $pk = $this->classe->getKeyName();
      $classe = $this->classe->buscar([$pk => $this->classe->getAttributeValue($pk)])[0];
      return response()->json($classe, Response::HTTP_CREATED);

     } catch (\Exception $e) {
      return response()->json([$e->getMessage()], Response::HTTP_UNAUTHORIZED);
     }

    }

    /**
     * Exclui um registro
     *
     * @param Request $request - Dados a serem excluidos
     * @return Json
     *
     */
    public function deletar(Request $request)
    {
     try {
      $this->classe->definir((array) $request->all());
      $this->classe->deletar();
      return response()->json([], Response::HTTP_OK);
     } catch (\Exception $e) {
      return response()->json([$e->getMessage()], Response::HTTP_UNAUTHORIZED);
     }
    }

    /**
     * Função de automatização de validação de formulario.
     *
     * @param Request $request
     * @return void
     */
    public function validar(Request $request)
    {
     $this->validate(
      $request,
      $this->classe->getValidar(),
      $this->classe->getMensagemValidar()
     );
    }

   public function gerarQRCode(Request $request) {

         $return = $request->getHttpHost();
         $tmp = $this->classe->buscar((array) $request->all())[0];
         $pk = $tmp->getAttributeValue($this->classe->getKeyName());
         $Classe =  strtolower(str_replace('App\\', '', $this->nomeClasse));

         $dt = new \DateTime();
         $p1 = $dt->format('sY');
         $p2 = $dt->format('Hs');

         $qr_code = new QrCode();

         $image = $qr_code::format('png')
                  ->size(300)->errorCorrection('H')
                  ->generate("$return/$Classe/qrcode/$p1"."a"."$pk"."z"."$p2");
         return response($image)->header('Content-type','image/png');
       }

    public function lerQRCode($qrcode) {

       $pk = explode("a",$qrcode);
       $pk = explode("z",$pk[1]);
       $pk = $pk[0];
       $Classe = strtolower(str_replace('App\\', '', $this->nomeClasse));

       $vcard = new VCard();
       $vcard->carrega(['objeto' => $Classe, 'chave' => $pk]);
       $vcard = $vcard->cartao;

       return response($vcard)
         ->header('Content-Type', 'text/vcard')
         ->header('lang', 'pt-BR')
         ->header('Content-Disposition', 'inline; filename="card.vcf"');
    }

    public function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => null
        ], 200);
    }

}

