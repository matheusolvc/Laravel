<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    protected $table = 'contas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function fornecedor()
    {
        return $this->belongsTo('App\Models\Conta', 'id_fornecedor');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Models\User', 'id_usuario');
    }

    public function colaborador()
    {
        return $this->belongsTo('App\Models\Colaborador', 'id_colaborador');
    }

    public function renegociacao()
    {
        return $this->hasMany('App\Models\Renegociacao', 'id_renegociacao');
    }
}
