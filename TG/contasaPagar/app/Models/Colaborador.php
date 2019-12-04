<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    protected $table = 'colaboradores';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function contas()
    {
        return $this->hasMany('App\Models\Conta', 'id_colaborador');
    }
}
