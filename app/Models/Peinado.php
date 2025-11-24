<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peinado extends Model {

    protected $table = 'peinado';
    
    protected $fillable = ['author', 'name', 'idpelo', 'description', 'price', 'image'];

    //relaciones
    function pelo() {
        return $this->belongsTo('App\Models\Pelo', 'idpelo');
    }

    function valoraciones() {
        return $this->hasMany('App\Models\Valoracion', 'idpeinado');
    }
    //fin relaciones

    function getPath() {
        $path = url('assets/img/afeitado.jpg');
        if($this->image != null &&
                file_exists(storage_path('app/public') . '/' . $this->image)) {
            $path = url('storage/' . $this->image);
        }
        return $path;
    }

    function getPdf() {
        // enlace, ruta https://
        // https://dwes.hopto.org/laraveles/barberApp/public/
        //storage/pdf/8.pdf
        return url('storage/pdf') . '/' . $this->id . '.pdf';
    }

    function isPdf() {
        // ruta de una rchivo dentro del ordenador
        //var/www/html/laraveles/barberApp/storage/
        //app/public/pdf/8.pdf
        return file_exists(storage_path('app/public/pdf') . '/' . $this->id . '.pdf');
    }
    
}