<?php

namespace App;

class Gta extends Modelo
{
    /*
     * Tabela modelo
     */
    protected $table = 'gta.gta';

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
    protected $fillable = ['numGTA', 'serieGTA', 'dataHoraEmissao', 'ano', 'mes', 'tipoDeTransporte', 'finalidade', 'especie', 'orig_Id', 'origem', 'dest_Id', 'destino', 'orig_Tipo', 'dest_Tipo', 'bovTotal', 'bovMacho', 'bovFemea', 'bov0a12Macho', 'bov0a12Femea', 'bov13a24Macho', 'bov13a24Femea', 'bov25a36Macho', 'bov25a36Femea', 'bovmais36Macho', 'bovmais36Femea', 'pagina',  'registrosPagina'];

    public function definir(array $parametros = [])
    {
        parent::definir($parametros);
        // $this->attributes['origem'] = $this->belongsTo('App\Estabelecimento','orig_Id','id');
        // $this->attributes['destino'] = $this->belongsTo('App\Estabelecimento','dest_Id','id');

    }

}
