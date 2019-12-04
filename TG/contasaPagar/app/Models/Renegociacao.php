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
        return $this->belongsTo('App\Models\Conta', 'id_renegociacao');
    }
}
