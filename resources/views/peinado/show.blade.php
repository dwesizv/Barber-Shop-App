@extends('app.bootstrap.template')

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
        {{ $peinado->hair }}
        {{ $peinado->price }} €
        </span>
    </p>
</main>
@endsection
