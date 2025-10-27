<?php

namespace App\Http\Controllers;

use App\Models\Peinado;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller {

    function about(): View {
        return view('main.about');
    }

    function main(): View {
        $peinados = Peinado::all();
        return view('main.main', ['peinados' => $peinados]);
    }
}