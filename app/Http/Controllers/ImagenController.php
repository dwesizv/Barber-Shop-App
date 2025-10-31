<?php

namespace App\Http\Controllers;

use App\Models\Peinado;
use Illuminate\Http\Request;

class ImagenController extends Controller {
    
    function imagen($idimagen) {
        $peinado = Peinado::find($idimagen);
        if($peinado == null || $peinado->image == null) {
            return response()->file('/var/www/html/laraveles/barberApp/public/assets/img/noimage.jpg');
        }
        return response()->file(storage_path('app/private') . '/' . $peinado->image);
    }
}