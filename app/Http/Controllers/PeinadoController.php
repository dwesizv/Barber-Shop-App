<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeinadoCreateRequest;
use App\Models\Peinado;
use App\Models\Pelo;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PeinadoController extends Controller
{
    function index(): View {
        $peinados = Peinado::all();//eloquent, da un array con todos los datos de la tabla
        return view('peinado.index', ['peinados' => $peinados]);
    }

    function create(): View {
        //$ids = Pelo::pluck('id');
        $pelos = Pelo::pluck('name', 'id'); //eloquent
        return view('peinado.create', ['pelos' => $pelos]);
    }

    function store(PeinadoCreateRequest $request): RedirectResponse {
        return back()->withInput();
        //eloquent ORM
        //queda validar los datos de entrada
        //primera forma: sencilla pero sin poder personalizar los mensajes
        /*$validatedData = $request->validate([
            'author' => 'required|string|min:2|max:60',
            'price'  => 'required|numeric|min:0|max:999999.99|decimal:0,2',
            'image'  => 'nullable|image|size:10'
        ]);*/
        //segunda forma
        /*$rules = [
            'author' => 'required|string|min:2|max:60',
            'price'  => 'required|numeric|min:0|max:999999.99|decimal:0,2',
            'image'  => 'nullable|image|size:10',
            'name'   => 'unique:peinado,name',
        ];
        $messages = [
            'author.required'   => 'Es obligatorio introducir al autor del peinado.',
            'author.string'     => 'El nombre del peinado tiene que ser una cadena.',
            'author.min'        => 'El nombre del autor no puede tener menos de 2 caracteres.',
            'author.max'        => 'El nombre del autor no puede tener menos de 60 caracteres.',
            'price.required'    => 'Es obligatorio introducir el precio del peinado.',
            'price.numeric'     => 'El precio del peinado tiene que ser un número.',
            'price.min'         => 'El precio del peinado no puede ser negativo.',
            'price.max'         => 'El precio del peinado no puede superar 1.000.000 euros.',
            'price.decimal'     => 'El precio del peinado ha de tener como mucho 2 decimales.',
            'image.image'       => 'El archivo tiene que ser una imagen.',
            'image.size'        => 'La imagen no puede pesar más de 10 KB.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()) {
            echo 'fallo';
            exit;
            //return back()->withInput()->withErrors($validator);
        }*/
        //si hay error -> return back()->withInput()->withErrors($message);
        //
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
            if($request->hasFile('pdf')) {
                $ruta = $this->uploadPdf($request, $peinado);
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

    private function uploadPdf(Request $request, Peinado $peinado) {
        $pdf = $request->file('pdf');
        $name = $peinado->id . '.' . $pdf->getClientOriginalExtension();
        $name = $peinado->id . '.pdf';
        $ruta = $pdf->storeAs('pdf', $name, 'public');
        $ruta = $pdf->storeAs('pdf', $name, 'local');
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
        $pelos = Pelo::pluck('name', 'id'); //eloquent
        return view('peinado.edit', ['peinado' => $peinado, 'pelos' => $pelos]);
    }

    function update(Request $request, Peinado $peinado): RedirectResponse {
        //validar los datos

        $result = false;
        if($request->deleteImage == 'true') {
            //borrado de ambos archivos
            $peinado->image = null;
        }
        $peinado->fill($request->all());
        $peinado->price = $peinado->price * 1.1;
        try {
            if($request->hasFile('image')) {
                $ruta = $this->upload($request, $peinado);
                $peinado->image = $ruta;
            }
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

    function pelo(Pelo $pelo): View {
        return view('peinado.pelo', ['pelo' => $pelo, 'peinados' => $pelo->peinados]);
    }
}
