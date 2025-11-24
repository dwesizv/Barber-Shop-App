<?php

namespace App\Http\Controllers;

use App\Models\Valoracion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ValoracionController extends Controller {

    function create(): View {
    }

    function destroy(Valoracion $valoracion): RedirectResponse {
    }

    function edit(Valoracion $valoracion): View {
    }

    function index(): View {
    }

    private function saveInSession(Request $request, int $id): void {
        $valoraciones = $request->session()->get('valoraciones');
        if($valoraciones == null||!is_array($valoraciones)) {
            $valoraciones = [];
        }
        $valoraciones[] = $id;
        $request->session()->put('valoraciones', $valoraciones);
    }

    function show(Valoracion $valoracion): View {
    }

    function store(Request $request): RedirectResponse {
        $result = false;
        $txtMessage = 'No se ha podido agregar el comentario';
        $valoracion = new Valoracion($request->all());
        try {
            $result = $valoracion->save();
            $this->saveInSession($request, $valoracion->id);
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

    function update(Request $request, Valoracion $valoracion): RedirectResponse {
    }
}