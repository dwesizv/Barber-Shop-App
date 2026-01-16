<?php

namespace App\Http\Controllers;

use App\Models\Peinado;
use App\Models\Pelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MainController extends Controller {

    function about(): View {
        return view('main.about');
    }

    function inyection(Request $request) {
        //seguridad
        //CSRF
        //parámetros limpian: quitan espacios iniciales y finales, cadena vacía -> null
        //consultas preparadas: eloquent
        $valor = $request->valor;
        $peinados1 = Peinado::where('idpelo', '=', $valor)->orderBy('id', 'asc')->get();
        $peinadosDB1 = DB::select('select * from peinado where idpelo = :idpelo order by id asc', ['idpelo' => $valor]);
        $peinadosDB2 = DB::select('select * from peinado where idpelo = ' . $valor . ' order by id asc');
        $sql = 'select * from peinado where idpelo = :idpelo order by id asc';
        $pdo = DB::connection()->getPdo();
        $sentence = $pdo->prepare($sql);
        $sentence->bindValue('idpelo', $valor);
        $sentence->execute();
        $peinadosPDO1 = [];
        foreach($sentence as $row) {
            $peinadosPDO1[] = $row;
        }
        $sql = 'select * from peinado where idpelo = ' . $valor . ' order by id asc';
        $pdo = DB::connection()->getPdo();
        $sentence = $pdo->prepare($sql);
        $sentence->execute();
        $peinadosPDO2 = [];
        foreach($sentence as $row) {
            $peinadosPDO2[] = $row;
        }
        dd($peinados1, $peinadosDB1, $peinadosDB2, $peinadosPDO1, $peinadosPDO2, $valor);
    }

    /*function main(): View {
        $peinados = Peinado::all();
        return view('main.main', ['peinados' => $peinados]);
    }*/

    function getField(?string $str): string {
        $values = [
            1 => 'id',
            2 => 'price',
            3 => 'idpelo'
        ];
        return $this->getParam($str, $values);
    }

    function getOrder(string|null $str): string {
        $values = [
            1 => 'asc',
            2 => 'desc'
        ];
        return $this->getParam($str, $values);
    }

    function getParam(?string $str, array $values): string {
        $result = $values[1];
        if(isset($values[$str])) {
            $result = $values[$str];
        }
        return $result;
    }

    function main(Request $request): View {
        //select * from peinado where ... order by ... limit posicionInicial, numeroRegistros
        //posicionInicial = (numeroPagina - 1) * numeroRegistros
        $field = $this->getField($request->field);
        $order = $this->getOrder($request->order);
        //$peinados = Peinado::orderBy($field, $order)->paginate(6)->withQueryString();
        $peinados = Peinadosa::query();
        return view('main.main', [
            'hasPagination' => true,
            'peinados'      => $peinados
        ]);
    }

    function sql(Request $request) {
        //eloquent
        $inicio = microtime(true);
        $peinados1 = Peinado::all();
        $peinados2 = Peinado::orderBy('name', 'desc')->get();
        $peinados3 = Peinado::where('idpelo', 1)->orderBy('id', 'asc')->get();
        $peinados4 = Peinado::where('idpelo', '>', 1)->orderBy('id', 'asc')->get();
        //$borrado = Peinado::where('idpelo', '>', 1)->delete();
        //$update = Peinado::where('idpelo', '>', 1)->update(['price' => 12]);
        $fin = microtime(true);
        $tiempo = $fin - $inicio;
        //DB
        $inicio = microtime(true);
        $peinadosDB1 = DB::select('select * from peinado');
        //$result = DB::insert('');
        //$result = DB::update('');
        //$result = DB::delete('');
        $peinadosDB2 = DB::select('select * from peinado order by name desc');
        $peinadosDB3 = DB::select('select * from peinado where idpelo = 1 order by id asc');
        $peinadosDB4 = DB::select('select * from peinado where idpelo > 1 order by id asc');
        $fin = microtime(true);
        $tiempo2 = $fin - $inicio;
        $inicio = microtime(true);
        $pdo = DB::connection()->getPdo();
        //$pdo = new PDO('mysql:host=localhost;dbname=barbershop', 'barberuser', 'barberpass');
        $sql = 'select * from peinado';
        $sentence = $pdo->prepare($sql);
        $sentence->execute();
        $peinadosPDO1 = [];
        foreach($sentence as $row) {
            $peinadosPDO1[] = $row;
        }
        $sql = 'select * from peinado order by name desc';
        $sentence = $pdo->prepare($sql);
        $sentence->execute();
        $peinadosPDO2 = [];
        foreach($sentence as $row) {
            $peinadosPDO2[] = $row;
        }
        $sql = 'select * from peinado where idpelo = 1 order by id asc';
        $sentence = $pdo->prepare($sql);
        $sentence->execute();
        $peinadosPDO3 = [];
        foreach($sentence as $row) {
            $peinadosPDO3[] = $row;
        }
        $sql = 'select * from peinado where idpelo > 1 order by id asc';
        $sentence = $pdo->prepare($sql);
        $sentence->execute();
        $peinadosPDO4 = [];
        foreach($sentence as $row) {
            $peinadosPDO4[] = $row;
        }
        $fin = microtime(true);
        $tiempo3 = $fin - $inicio;
        dd($peinados1, $peinados2, $peinados3, $peinados4, 
            $peinadosDB1, $peinadosDB2, $peinadosDB3, $peinadosDB4,
            $peinadosPDO1, $peinadosPDO2, $peinadosPDO3, $peinadosPDO4,
            $tiempo, $tiempo2, $tiempo3);
    }
}