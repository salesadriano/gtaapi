<?php

namespace App;

class Estabelecimento extends Modelo
{
    /*
     * Tabela modelo
     */
    protected $table = 'gta.estabelecimento';

    /*
     * Id da tabela
     */
    protected $primaryKey = 'id';

    /*
     * Define o marcador de timeStamp "false"
     */
    public $timestamps = false;

    /**
     * Atributos do modelo.
     *
     * @var array
     */
    protected $fillable = [ 'id', 'codUF', 'UF', 'nomUF', 'codMunicipio', 'municipio', 'latitude', 'longitude', 'tipoDeEstabelecimento', 'GTAs','ano', 'pagina',  'registrosPagina'];

    public function definir(array $parametros = [])
    {
        parent::definir($parametros);
        if (!isset($parametros['ano']) ) $this->attributes['ano'] = date("Y");
        if ($this->completo) $this->attributes['GTAs'] = $this->hasMany('App\Gta','id','orig_Id', ["ano"=> $this->attributes['ano']], $this->completo);
    }

}
