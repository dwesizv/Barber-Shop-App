<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peinado extends Model {
    
    //4º atributos

    protected $table = 'peinado';
    
    protected $fillable = ['author', 'name', 'hair', 'description', 'price', 'image'];
}
