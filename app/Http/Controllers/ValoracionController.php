<?php

namespace App\Http\Controllers;

use App\Models\Valoracion;
use Illuminate\Http\Request;

class ValoracionController extends Controller
{
    function index() {
        //
    }

    function create() {
        //
    }

    function store(Request $request) {
        $result = false;
        $txtMessage = 'No se ha podido agregar el comentario';
        $valoracion = new Valoracion($request->all());
        try {
            $result = $valoracion->save();
            //guardo en la sesión que ha creado ese mensaje
            $valoraciones = $request->session()->get('valoraciones');
            if($valoraciones == null||!is_array($valoraciones)) {
                $valoraciones = [];
            }
            $valoraciones[] = $valoracion->id;
            $request->session()->put('valoraciones', $valoraciones);
            //session();
            $txtMessage = 'Comentario agregado correctamente';
        } catch(\Exception $e) {
        }
        $message = [
            'mensajeTexto' => $txtMessage,
        ];
        if($result) {
            //return redirect()->route('peinado.show', $valoracion->idpeinado)->with($message);
            return back()->with($message);
        } else {
            return back()->withInput()->withErrors($message);
        }
    }

    function show(Valoracion $valoracion) {
        //
    }

    function edit(Valoracion $valoracion) {
        //
    }

    function update(Request $request, Valoracion $valoracion) {
        //
    }

    function destroy(Valoracion $valoracion) {
        //
    }
}
