<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelo extends Model {
    
    protected $table = 'pelo';
    public $timestamps = false;
    
    protected $fillable = ['name'];

    //relación con el modelo Peinado, un tipo de pelo tiene muchos peinados
    function peinados(): HasMany {
        return $this->hasMany('App\Models\Peinado', 'idpelo');
    }
}