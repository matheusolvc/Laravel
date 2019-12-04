<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedores';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function contas()
    {
        return $this->hasMany('App\Models\Conta', 'id_fornecedor');
    }
}
