<?php

namespace App;

class Entidade extends Modelo
{
    /*
     * Tabela modelo
     */
    protected $table = 'fwork.entidade';

    /*
     * Id da tabela
     */
    protected $primaryKey = 'idEntidade';

    /*
     * Define o marcador de timeStamp "false"
     */
    public $timestamps = false;

    /**
     * Atributos do modelo.
     *
     * @var array
     */
    protected $fillable = [ 'idEntidade', 'razaoEntidade', 'FantasiaEntidade', 'siglaEntidade', 'cnpjEntidade', 'situacaoEntidade', 'enderecos' ];

    public function definir(array $parametros = [])
    {
        parent::definir($parametros);

    }

}
