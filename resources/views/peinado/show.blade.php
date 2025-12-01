@extends('app.bootstrap.template')

@section('styles')
<link rel="stylesheet" href="{{ url('assets/css/estrellas.css') }}">
@endsection

@section('content')

<header class="masthead bg-secondary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <img style="padding:12px;" class="masthead-avatar mb-5" src="{{ $peinado->getPath() }}" alt="..." width="300px"/>
        <h1 class="masthead-heading text-uppercase mb-0">{{ $peinado->name }}</h1>
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <p class="masthead-subheading font-weight-light mb-0">{{ $peinado->price }}€</p>
    </div>
 </header>

<main class="px-3" style="padding:24px;">
    <!--<h1>{{ $peinado->name }}</h1>
    <p class="lead">
        <img src="{{ $peinado->getPath() }}" width="30%">
    </p>
    <p class="lead">
        <img src="{{ route('imagen.imagen', $peinado->id) }}" width="30%">
    </p>
    @if($peinado->isPdf())
    <p class="lead">
        <a href="{{ $peinado->getPdf() }}" target="pdf">PDF</a>
    </p>
    @endif-->
    <p class="lead">
        {{ $peinado->description }}
    </p>
    <p class="lead">
        <a href="#" class="btn btn-lg btn-light fw-bold border-white bg-white">
            {{ $peinado->author }}
        </a>
        <span class="fw-bold border-white bg-white">
        {{ $peinado->pelo->name }}
        {{ $peinado->price }} €
        </span>
    </p>
    @foreach($peinado->valoraciones as $valoracion)
        <hr>
        <p class="lead">
            {{ $valoracion->comment }}
            @if(session('valoraciones') != null && in_array($valoracion->id, session('valoraciones')))
                <a href="{{ route('valoracion.edit', $valoracion->id) }}">editar comentario</a>
            @endif
        </p>
        <p class="text-end">
            {{ $valoracion->created_at->format('d/m/Y') }}
            @for($i = 1; $i <= $valoracion->rate; $i++)
                ★
            @endfor
        </p>
    @endforeach
    <hr>
    <form method="post" action="{{ route('valoracion.store') }}">
        @csrf
        <input type="hidden" name="idpeinado" value="{{ $peinado->id }}">
        <label for="comment">Comentario</label>
        <textarea class="form-control" minlength="20" id="comment" name="comment"
            placeholder="Comment for the hairstyle" cols="60" rows="3" >{{ old('comment') }}</textarea>
        <p class="clasificacion">
            <input id="radio1" type="radio" name="rate" value="5">
            <label for="radio1">★</label>
            <input id="radio2" type="radio" name="rate" value="4">
            <label for="radio2">★</label>
            <input id="radio3" type="radio" name="rate" value="3">
            <label for="radio3">★</label>
            <input id="radio4" type="radio" name="rate" value="2">
            <label for="radio4">★</label>
            <input id="radio5" type="radio" name="rate" value="1">
            <label for="radio5">★</label>
        </p>
        <input class="btn btn-primary" value="Agregar comentario" type="submit">
    </form>
</main>
@endsection
