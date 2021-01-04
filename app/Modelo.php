<?php

namespace App;

use App\Banco;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Response;


// TODO Especializar as Expitions
/**
 * Classe que traz atributos e métodos padrão para o sistema
 * @author Adriano Sales Santos <sales.adriano@macsolucoes.com>
 * @author Marcus Aurelius de Araújo Hakozaki <marcus.hakozaki@macsolucoes.com>
 *
 * @version 1.0.1
 */
class Modelo extends Model
{
    /**
     * Classe de conexão ao banco de dados
     *
     * @var banco
     */
    protected $banco;
    /**
     * Representa a classe que herdou os atributos e métodos do modelo
     *
     * @var Class
     */
    private $nomeClasse;

    /**
     * defini se os dados das classes que são atributos nesta classe serão retornados
     * se definido como true só os dados da classe serão retornados, se definido como
     * true os dados de todas as classes definidas como atributo (classes filhas) serão
     * recuperados (necessário implementar retorno nas classes herdeiras)
     *
     * @var boolean
     */
    protected $completo = true;

    /**
     * Campos obrigatórios na tabela.
     *
     * @var array
     */
    protected $validar = [];

    /**
     * Construtor da Classe
     *
     * @param Array $parametros - dados iniciais da classe
     * @param Bool $name Bool $completo - indica se serão retornados os objetos dependentes
     *
     */
    public function __construct(Array $parametros = [], Bool $completo=true )
    {
        $this->banco = new Banco($this);
        $this->completo = $completo;

        if (count($parametros) > 0) {
            $this->definir($parametros);
        }
        $this->nomeClasse = get_class($this);

        $this->carregaValidar();

    }

    /**
     * encapsulamento de atributo
     *
     * @param Bool $value
     *
     */
    public function setCompleto(Bool $value)
    {
        $this->completo = $value;
    }

    /**
     * encapsulamento de atributo
     *
     * @return Bool
     *
     */
    public function getCompleto()
    {
        return $this->completo;
    }

    /**
     * Carrega dados na classe a partir do array passado como parâmetro
     *
     * @param Array $parametros
     *
     */
    public function definir(Array $parametros)
    {
        try {
            $this->fill($parametros);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Carrega dados do banco na classe, dados no array são usados como
     * parâmetros para busca
     *
     * @param Array $parametros
     *
     */
    public function carrega(Array $parametros = [])
    {
        if (!count($parametros) > 0) {
            $parametros = $this->getAttributes();
        }

        try {
            $this->definir((array) $this->banco->get($parametros)->first());
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Busca registros no banco a partir dos parâmetros passados
     *
     * @param Array $parametros
     * @param Bool $name Bool $completo - indica se serão retornados os objetos dependentes
     * @return Modelo[]
     */
    public function buscar(array $parametros = [], Bool $completo = true)
    {
        $retorno = [];

        if (!count($parametros) > 0) {
            $parametros = $this->getAttributes();
        }
        try {
            foreach ($this->banco->get($parametros) as $reg) {
                $retorno[] = new $this->nomeClasse((array) $reg, $completo);
            };
            return $retorno;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Função que persiste uma classe;
     *
     * @param Array $parametros Classe com os dados para persistir.
     * @return Modelo Retorna a classe persistida.
     *
     */
    public function salvar(array $parametros = [])
    {
        if (!count($parametros) > 0) {
            $parametros = $this->getAttributes();
        }
        try {
            $this->fill((array) $this->banco->set($parametros));
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Função que remove um registro;
     *
     */
    public function deletar()
    {
        try {
            $this->banco->rm();
            foreach ($this->fillable as $tmp) {
                $this->attributes[$tmp] = null;
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * executa consulta no banco baseada em uma script
     *
     * @param String $scriptSQL
     * @param Array $parametros
     * @param String $tipoFiltro
     * @return Modelo
     */
    public function exec(String $scriptSQL, Array $parametros = [], String $tipoFiltro='F')
    {
        try {
            return $this->banco->exec($scriptSQL, $parametros, $tipoFiltro);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * retorna parameteros da procedure de busca do banco
     *
     * @return Array
     */
    public function retornaParametros() {
       return $this->banco->retornaParametros();
    }

    /**
     * Retorna os campos obrigatórios da tabela.
     *
     * @return array
     */
    public function getValidar()
    {
        return $this->validar;
    }

    /**
     * Retorna os campos obrigatórios da tabela.
     *
     * @return array
     */
    public function getMensagemValidar()
    {
        $mensagens = [];

        foreach ($this->getValidar() as $chave => $valor) {
            foreach (explode('|',$valor) as $explodeValor ) {
                $mensagens [] = [$chave . '.' . $explodeValor => $this->retornaMensagem($explodeValor)];
            }
        }

        return $mensagens;
    }

    /**
     * Retorna os campos obrigatórios da tabela.
     * @param String $valor -
     * @return array
     */
    private function retornaMensagem(String $valor)
    {
        switch ($valor) {
            case 'required':
                $retorno = ':Attribute é obrigatório.';
                break;

            case 'accepted':
                $retorno = ':Attribute tem que ser YES ou 1.';
                break;

            case 'alpha':
                $retorno = ':Attribute só pode conter caracteres.';
                break;

            case 'email':
                $retorno = ':Attribute tem que ser um e-mail.';
                break;

            case 'integer':
                $retorno = ':Attribute tem que ser um número inteiro.';
                break;

            default:
                $retorno = ':attribute';
                break;
        }

        return $retorno;
    }

    /**
     * inclui classe na lista one-to-one
     *
     * @param String $classe
     * @param String $foringKey
     * @param String $localKey
     * @return boolean
     */
    public function hasOne($classe, $localKey = null, $foringKey = null, $completo = true) {

      if (is_null($localKey)) $localKey = $this->getKeyName();
      if (is_null($foringKey)) $foringKey = $this->getKeyName();
      if (!array_key_exists($localKey, $this->attributes) || is_null($this->attributes[$localKey])) return null;

      $retorno = new $classe();
      $retorno = $retorno->buscar([$foringKey => $this->attributes[$localKey]], $completo);
      if (count($retorno) > 0 ) return $retorno[0];
      return null;
    }

    /**
     * inclui classe na lista one-to-many
     *
     * @param String $classe
     * @param String $foringKey
     * @param String $localKey
     * @return boolean
     */
    public function hasMany($classe, $localKey = null, $foringKey = null, Array $parametros = null, Bool $completo = true) {

      if (is_null($parametros)) $parametros = [];
      if (is_null($localKey)) $localKey = $this->getKeyName();
      if (is_null($foringKey)) $foringKey = $this->getKeyName();
      if (!array_key_exists($localKey, $this->attributes)  || is_null($this->attributes[$localKey])) return null;

      $dados = new $classe();
      $parametros += [$foringKey => $this->attributes[$localKey]];
      return $dados->buscar($parametros,$completo);
    }

    /**
     * retorna classe a qual a classe atual está subordinada
     *
     * @param $classe
     * @param $localKey
     * @return boolean
     */
    public function belongsTo($classe, $localKey = Null, $ownerKey = NULL, $relation = NULL) {

      $retorno = new $classe();
      $foringKey = $retorno->getKeyName();
      if (is_null($localKey)) $localKey = $foringKey;
      if (!array_key_exists($localKey, $this->attributes) || is_null($this->attributes[$localKey]) ) return null;

      $retorno = $retorno->buscar([$foringKey => $this->attributes[$localKey]], false);
      if (count($retorno) > 0 ) return $retorno[0];
      return null;
    }

    /**
     * inclui classe na lista de filhos
     *
     * @param String $foringKey
     * @return Class[]
     */
    public function hasChild(String $foringKey, Bool $completo = true) {

      if (!array_key_exists($foringKey, $this->attributes) ) return null;

      $class = get_class($this);
      $tmp = new $class();
      return $tmp->buscar([$foringKey => $this->attributes[ $this->getKeyName()]], $completo);

    }

    private function carregaValidar() {

        $nomeTabela = explode(".", $this->table);
        $nomeTabela = $nomeTabela[count($nomeTabela)-1] ;

        foreach ($this->banco->query("fWork.getCamposObrigatorios '$nomeTabela'") as $reg) {
            $validar[] = [$reg->name => 'required'];
        };

    }

}
