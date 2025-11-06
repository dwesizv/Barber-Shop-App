@extends('app.bootstrap.template')

@section('content')
<main class="px-3">
    <h1>{{ $peinado->name }}</h1>
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
    @endif
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