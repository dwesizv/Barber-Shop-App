<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelo extends Model {
    
    protected $table = 'pelo';
    public $timestamps = false;
    
    protected $fillable = ['name'];

    function peinados() {
        return $this->hasMany('App\Models\Peinado', 'idpelo');
    }
}