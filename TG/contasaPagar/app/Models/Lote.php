<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    protected $table = 'lotes';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function contas()
    {
        return $this->hasMany('App\Models\Conta', 'id_conta');
    }

    public function retorno()
    {
        return $this->hasOne('App\Models\RetornoLote', 'id_lote');
    }
}
