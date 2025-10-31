<?php

namespace App\Http\Controllers;

use App\Models\Peinado;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PeinadoController extends Controller
{
    function index(): View {
        $peinados = Peinado::all();//eloquent, da un array con todos los datos de la tabla
        return view('peinado.index', ['peinados' => $peinados]);
    }

    function create(): View {
        return view('peinado.create');
    }

    function store(Request $request): RedirectResponse {
        //eloquent ORM
        //queda validar los datos de entrada
        $peinado = new Peinado($request->all());//eloquent
        $result = false;
        try {
            $result = $peinado->save();//eloquent, inserta objeto en la tabla
            $txtmessage = 'The haircut has been added.';
            //si llega el archivo, lo subo y lo guardo
            if($request->hasFile('image')) {
                $ruta = $this->upload($request, $peinado);
                $peinado->image = $ruta;
                $peinado->save();
            }
        } catch(UniqueConstraintViolationException $e) {
            $txtmessage = 'Clave única.';
        } catch(QueryException $e) {
            $txtmessage = 'Campo null';
        } catch(\Exception $e) {
            $txtmessage = 'Error fatal';
        }
        $message = [
            'mensajeTexto' => $txtmessage,
        ];
        if($result) {
            return redirect()->route('main')->with($message);
        } else {
            return back()->withInput()->withErrors($message);
        }
    }

    private function upload(Request $request, Peinado $peinado) {
        $image = $request->file('image');
        $name = $peinado->id . '.' . $image->getClientOriginalExtension();
        $ruta = $image->storeAs('peinado', $name, 'public');
        $ruta = $image->storeAs('peinado', $name, 'local');
        //$rutaEntera1 = storage_path('app/public') . '/' . $ruta1;
        //$rutaEntera2 = storage_path('app/private') . '/' . $ruta2;
        return $ruta;
    }

    function show(Peinado $peinado): View {
        //laravel: inyección de dependencia -> convierte el número del id en el objeto
        //return view('peinado.show', compact('peinado'));
        return view('peinado.show', ['peinado' => $peinado]);
    }
    
    /*function show($id) {
        $peinado = Peinado::find($id);
        if($peinado == null) {
            abort(404);
        }
        dd($peinado);
    }*/

    function edit(Peinado $peinado): View {
        return view('peinado.edit', ['peinado' => $peinado]);
    }

    function update(Request $request, Peinado $peinado): RedirectResponse {
        $result = false;
        $peinado->fill($request->all());
        $peinado->price = $peinado->price * 1.1;
        try {
            $result = $peinado->save();
            //$result = $peinado->update($request->all());
            $txtmessage = 'The haircut has been edited.';
        } catch(UniqueConstraintViolationException $e) {
            $txtmessage = 'Primary key.';
        } catch(QueryException $e) {
            $txtmessage = 'Null value.';
        } catch(\Exception $e) {
            $txtmessage = 'Fatal error.';
        }
        $message = [
            'mensajeTexto' => $txtmessage,
        ];
        if($result) {
            return redirect()->route('main')->with($message);
        } else {
            return back()->withInput()->withErrors($message);
        }
    }

    function destroy(Peinado $peinado): RedirectResponse {
        try {
            $result = $peinado->delete();
            $textMessage = 'El peinado se ha eliminado.';
        } catch(\Exception $e) {
            $textMessage = 'El peinado no se ha podido eliminar.';
            $result = false;
        }
        $message = [
            'mensajeTexto' => $textMessage,
        ];
        if($result) {
            return redirect()->route('main')->with($message);
        } else {
            return back()->withInput()->withErrors($message);
        }
    }
}