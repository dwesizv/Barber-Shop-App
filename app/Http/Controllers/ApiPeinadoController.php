<?php

namespace App\Http\Controllers;

use App\Models\Peinado;
use App\Traits\JsonTrait;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiPeinadoController extends Controller
{

    use JsonTrait;

    function index(): JsonResponse {
        $peinados = Peinado::all();
        return $this->jsonResponse($peinados, 'peinado list');
    }

    function store(Request $request) {
        //hay que validar los datos, como siempre
        $peinado = new Peinado($request->all());
        //$peinado->iduser = Auth::user()->id;
        $peinado->iduser = 1;
        try {
            $peinado->save();
            $result = true;
        } catch(\Exception $e) {
            $peinado = null;
            $result = false;
        }
        return $this->jsonResponse($peinado, 'peinado store', $result);
    }

    function show(string $id): JsonResponse {
        $peinado = Peinado::find($id);
        if($peinado == null) {
            return $this->jsonResponse(null, 'peinado item', false);
        }
        return $this->jsonResponse($peinado, 'peinado item');
    }

    function update(Request $request, string $id) {
    }

    function destroy(string $id) {
    }

    function guzzle($id = 0) {
        $client = new Client([
            'base_uri' => 'https://dwes.hopto.org/',
            'timeout'  => 5.0,
        ]);
        //$url = "laraveles/barberApp/public/api/peinado";
        $resultado = session('guzzle', []);
        /*if($id > 0) {
            $url = "laraveles/barberApp/public/api/peinado/$id";
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);
            $resultado[] = $data;
            session()->put('guzzle', $resultado);
            $id = $id - 1;
            $url = "laraveles/barberApp/public/api/guzzle/$id";
            $client->get($url);
        } else {
            dd($resultado);
        }*/
        $resultado = [];
        while($id > 0) {
            $url = "laraveles/barberApp/public/api/peinado/$id";
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);
            $resultado[] = $data;
            $id = $id - 1;
        }
        dd($resultado);
        //$response = $client->get($url);
        //$data = json_decode($response->getBody(), true);
        //dd($response, $data, $id);
    }
}
