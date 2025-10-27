@extends('app.bootstrap.template')

@section('content')
<main class="px-3">
    <h1>{{ $peinado->name }}</h1>
    <p class="lead">
        <img src="{{ url('assets/img/afeitado.jpg') }}" width="30%">
    </p>
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