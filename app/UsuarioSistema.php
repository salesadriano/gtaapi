<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Support\Facades\Hash;


class UsuarioSistema extends Modelo implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    /*
     * Tabela modelo
     */
    protected $table = 'fwork.usuarioSistema';

    /*
     * Id da tabela
     */
    protected $primaryKey = 'idUsuarioSistema';

    /*
     * Define o marcador de timeStamp "false"
     */
    public $timestamps = false;

    /**
     * Atributos do modelo.
     *
     * @var array
     */
    protected $fillable = [
        'idUsuarioSistema', 'loginUsuarioSistema', 'nomeUsuarioSistema', 'emailUsuarioSistema',
        'senhaUsuarioSistema', 'situacaoUsuarioSistema', 'token', 'entidades'
    ];

    protected $hidden = ['senhaUsuarioSistema', 'loginUsuarioSistema'];

    public function setSenhaUsuarioSistemaAttribute($value)
    {
        $this->attributes['senhaUsuarioSistema'] = Hash::make($value);
    }

    public function definir(array $parametros = [])
    {
        parent::definir($parametros);
        if ($this->completo) $this->attributes['entidades'] = $this->hasMany('App\UsuarioEntidade',null,null, false);
    }

}
