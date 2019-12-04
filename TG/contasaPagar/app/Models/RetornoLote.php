<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RetornoLote extends Model
{
    protected $table = 'lotes';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function lote()
    {
        return $this->belongsTo('App\Models\Lote', 'id_lote');
    }
}
