<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    protected $table = 'valoracion';
    
    protected $fillable = ['idpeinado', 'rate', 'comment'];

    function peinado() {
        return $this->belongsTo('App\Models\Peinado', 'idpeinado');
    }
}
