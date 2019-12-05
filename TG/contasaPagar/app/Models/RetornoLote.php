<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RetornoLote extends Model
{
    protected $table = 'retorno_lotes';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_lote',
        'status',
        'mensagem'
    ];

    public function lote()
    {
        return $this->belongsTo('App\Models\Lote', 'id_lote');
    }
}
