<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renegociacao extends Model
{
    protected $table = 'renegociacoes';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function conta()
    {
        return $this->belongsTo('App\Models\Conta', 'id_conta');
    }

    public function contas()
    {
        return $this->hasMany('App\Models\Conta', 'id_renegociacao');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Models\User', 'id_usuario');
    }
}
