<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Banco
{
    private $nomeModelo = '';
    private $modelo;

    /**
     * Construtor da Classe
     *
     * @param Model $modelo - Classe de modelo que utiliza a conexão.
     */
    public function __construct(Model &$modelo = null)
    {
        if ($modelo != null) {
            $this->nomeModelo = $this->retornaNomeClasse($modelo);
            $this->modelo = $modelo;
        }
    }

    /**
     * * Função que executa a procedure "getControleCriterios" que retorna a
     * procedure get,set ou rm da classe .
     *
     *  @access private
     *  @param String $filtro Tipo de filtro 'F' - GET ;'S' - SET;'E' - RM
     *  @return String Retorna a procedure.
     */
    private function retornaOrigemDados($tipofiltro, $procedure = null)
    {
        $controleCriterios = collect(DB::select("exec fwork.getControleCriterio @tipofiltro = '$tipofiltro' , @origemCriterio = '$this->nomeModelo' "))->first();
        $linha = (array) $controleCriterios;

        return $linha['origemDados'];
    }

    /**
     * * Função que executa a procedure "getCamposProcedure" e retorna
     * um conjunto campos usados como parametro de uma procedure.
     *
     *  @access private
     *  @param String $filtro Tipo de filtro
     * 'F' - Pesquisa ;'S' - Salvar;'R' - Remover
     *  @return Array[] Retorna o conjunto de parametros de uma procedure.
     */
    public function retornaParametros($tipofiltro = 'F', $procedure = null)
    {
        if ($procedure == null) {
            $procedure = $this->retornaOrigemDados($tipofiltro);
        }

        $nomeProcedure = explode(' ', $procedure)[0];
        //Variavel que recebe os parametros de uma procedure do banco
        return DB::select("exec fwork.getCamposProcedure '$nomeProcedure'");
    }

    /**
     * * Função que retorna o nome da classe sem o "\App"
     *
     *  @access private
     *  @return String Retorna o nome da classe sem o "\App".
     */
    public function retornaNomeClasse(&$classe)
    {
        return substr(get_class($classe), strrpos(get_class($classe), '\\') + 1);
    }

    /**
     * Função que retorna uma SCRIPT para a execução no banco de dados.
     *
     * @access private
     * @param Illuminate\Database\Eloquent\Model $modelo Modelo base.
     * @param Array $parametros Parametros da SCRIPT.
     * @param String $tipofiltro Tipo do filtro 'F' PROCURAR / 'S' SALVAR / 'E' REMOVER
     * @return String Retorna uma script.
     */
    private function retornaScript(array $parametros = [], $tipofiltro = 'F', $procedure = null)
    {
        if (!count($parametros) > 0 && isset($this->modelo)) {$parametros = $this->modelo->getAttributes();}
        //Verifica as variaveis de SESSÃO(DO MIDDLEWARE RequestToken) ou do \Auth
        if (isset($_SESSION['userName']) && !strpos(strtoupper($procedure), "@USERNAME")) {
            if (!count($parametros) > 0) {
                $parametros = ['userName' => $_SESSION['userName']];
            } else {
                $parametros += ['userName' => $_SESSION['userName']];
            }
            $parametros += ['senha' => $_SESSION['senha']];
        } elseif (Auth::check() && !strpos(strtoupper($procedure), "@USERNAME")) {
            if (!count($parametros) > 0) {
                $parametros = ['userName' => Auth::User()->loginUsuarioSistema];
            } else {
                $parametros += ['userName' => Auth::User()->loginUsuarioSistema];
            }
            $parametros += ['senha' => Auth::User()->senhaUsuarioSistema];
        }

        //Variavel que recebe os parametros de uma procedure do banco
        $parametros_banco = $this->retornaParametros($tipofiltro, $procedure);

        $arroba = '@';
        $exec = strpos($procedure, 'exec ') == false ? 'exec ' : '';
        $where = '';

        //Variavel que recebe a script
        if ($procedure == null) {
            $procedure = $this->retornaOrigemDados($tipofiltro);
        }

        if (is_numeric(strpos(strtoupper($procedure), "SELECT")) ||
            is_numeric(strpos(strtoupper($procedure), "INSERT")) ||
            is_numeric(strpos(strtoupper($procedure), "DELETE")) ||
            is_numeric(strpos(strtoupper($procedure), "UPDATE"))) {
            $arroba = '';
            $exec = '';
            $where = ' where ';
        }

        $script = $exec . $procedure;

        //Atributos do Modelo (em caixa baixa)
        $parametros = array_change_key_case($parametros);

        //Atributo de verificação de atributos da classe
        $temParametros = false;

        //Laço que verifica os parametros preenchidos
        //do objeto com os parametros da procedure do banco
        foreach ($parametros_banco as $parametro_banco) {
            $parametro_banco = (array) $parametro_banco;

            $nome = strtolower($parametro_banco["name"]);

            if (array_key_exists($nome, $parametros) && strlen($parametros[$nome]) > 0) {

                $temParametros = true;

                if ((is_numeric(strpos($script, ' @')) || is_numeric(strpos($script, ' where '))) && substr(rtrim($script), strlen($script) - 2, 1) != ',') {
                    $script .= ', ';
                }

                if (!is_numeric(strpos($script, ' where '))) {
                    $script .= $where;
                }

                switch ($parametro_banco["tipo"]) {
                    case 'varchar':
                    case 'date':
                    case 'datetime':
                        $valor = rtrim(ltrim($parametros[$nome]));
                        $valor = strlen($valor) > 0 ? "'$valor'" : '';
                        break;
                    case 'numeric':
                        $valor = rtrim(ltrim($parametros[$nome]));
                        break;
                    case 'int':
                        $valor = rtrim(ltrim($parametros[$nome]));
                        break;
                    default:
                        $valor = rtrim(ltrim($parametros[$nome]));
                        $valor = strlen($valor) > 0 ? "'$valor'" : '';
                }

                if (strlen($valor) > 0) {
                    $script .= " @$nome = $valor, ";
                } else {
                    $script .= " $arroba$nome = null, ";
                }

            }
        }

        foreach ($parametros as $chave => $valor) {
            if (is_string($valor)) {
                $script = str_replace("|$chave|", $valor, $script);
            }

        }

        //Retira a virgula final
        if ($temParametros) {
            $script = substr($script, 0, strlen($script) - 2);
        }

        return $script;
    }

    /**
     * * Função que retorna os valores de uma pesquisa.
     *
     *  @access public
     *  @param Illuminate\Database\Eloquent\Model $modelo Classe base.
     *  @return Array Retorna os registros pesquisados .
     */
    public function get(array $parametros = [])
    {
        if (!count($parametros) > 0) {
            $parametros = $this->modelo->getAttributes();
        }

        $script = $this->retornaScript($parametros, 'F');

        try {
          if (env("SQL_DEBUG")) Log::info($this->trataErro($script));
          return collect(DB::select($script));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new \Exception($this->trataErro($e->getMessage()));
        }
    }

    /**
     * * Função que persiste uma classe;
     *
     *  @access public
     *  @param Illuminate\Database\Eloquent\Model $modelo Classe base.
     *  @return Array Retorna a classe persistida.
     */
    public function set(array $parametros = [])
    {

        if (!count($parametros) > 0) {
            $parametros = $this->modelo->getAttributes();
        }

        $script = $this->retornaScript($parametros, 'S');

        try {
          if (env("SQL_DEBUG")) Log::info($this->trataErro($script));
          return collect(DB::select($script))->first();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new \Exception($this->trataErro($e->getMessage()));
        }
    }

    /**
     * * Função que remove um registro.
     *
     *  @access public
     *  @param Illuminate\Database\Eloquent\Model $modelo Classe base.
     *  @return Array Retorno da função do banco.
     */
    public function rm(array $parametros = [])
    {
        if (!count($parametros) > 0) {
            $parametros = $this->modelo->getAttributes();
        }

        $script = $this->retornaScript($parametros, 'E');

        try {
          if (env("SQL_DEBUG")) Log::info($this->trataErro($script));
          DB::Delete($script);
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new \Exception($this->trataErro($e->getMessage()));
        }
    }

    /**
     * * Função que executa uma "Stored Procedure"
     *
     *  @access public
     *  @param String $storedProcedure Nome da Stored Procedure.
     *  @param Array $parametros Parametros da Stored Procedure.
     *  @return Array[] Retorno da função do banco.
     */
    public function exec($scriptSQL, array $parametros = [], $tipofiltro = 'F')
    {
        $script = $this->retornaScript($parametros, $tipofiltro, $scriptSQL);

        try {
            if (is_numeric(strpos(strtoupper($scriptSQL), "INSERT"))) {
                if (env("SQL_DEBUG")) Log::info($this->trataErro($script));
                DB::insert($script);
                return true;
            }
            if (is_numeric(strpos(strtoupper($scriptSQL), "DELETE"))) {
              if (env("SQL_DEBUG")) Log::info($this->trataErro($script));
              DB::delete($script);
                return true;
            }
            if (is_numeric(strpos(strtoupper($scriptSQL), "UPDATE"))) {
              if (env("SQL_DEBUG")) Log::info($this->trataErro($script));
              DB::update($script);
                return true;
            }
            if (env("SQL_DEBUG")) Log::info($this->trataErro($script));
            return DB::select($script);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new \Exception($this->trataErro($e->getMessage()));
        }
    }

    /**
     * * Função que executa uma "Stored Procedure"
     *
     *  @access public
     *  @param String $storedProcedure Nome da Stored Procedure.
     *  @return Array[] Retorno da função do banco.
     */
    public function query($scriptSQL)
    {
        try {
            if (is_numeric(strpos(strtoupper($scriptSQL), "INSERT"))) {
              DB::insert($scriptSQL);
                return true;
            }
            if (is_numeric(strpos(strtoupper($scriptSQL), "DELETE"))) {
              DB::delete($scriptSQL);
                return true;
            }
            if (is_numeric(strpos(strtoupper($scriptSQL), "UPDATE"))) {
              DB::update($scriptSQL);
                return true;
            }
            return DB::select($scriptSQL);
        } catch (\Exception $e) {
          if (env("SQL_DEBUG")) Log::info($this->trataErro($scriptSQL));
          Log::error($e->getMessage());
            throw new \Exception($this->trataErro($e->getMessage()));
        }
    }

    public function trataErro($msg)
    {
        $tmp = explode("]", $msg);
        $tmp = explode("(", $tmp[count($tmp) - 1])[0];
        $tmp = str_replace("'", "`", $tmp);
        $tmp = str_replace('"', '`', $tmp);
        return $tmp;
    }
}
