<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Peinado extends Model {

    protected $table = 'peinado';

    protected $fillable = ['author', 'name', 'idpelo', 'description', 'price', 'image'];

    //ruta del archivo de la imagen del peinado
    function getPath(): string {
        $path = url('assets/img/afeitado.jpg');
        if($this->image != null &&
                file_exists(storage_path('app/public') . '/' . $this->image)) {
            $path = url('storage/' . $this->image);
        }
        return $path;
    }

    //ruta del archivo pdf del peinado
    function getPdf(): string {
        return url('storage/pdf') . '/' . $this->id . '.pdf';
    }

    //comprobar si existe el archivo pdf del peinado
    function isPdf(): bool {
        return file_exists(storage_path('app/public/pdf') . '/' . $this->id . '.pdf');
    }

    //relación con el modelo Pelo, un peinado tiene un tipo de pelo
    function pelo(): BelongsTo {
        return $this->belongsTo('App\Models\Pelo', 'idpelo');
    }

    //relación con el modelo Valoración, un peinado tiene muchas valoraciones
    function valoraciones(): HasMany {
        return $this->hasMany('App\Models\Valoracion', 'idpeinado');
    }
}