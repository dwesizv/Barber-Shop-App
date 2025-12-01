@extends('app.bootstrap.template')

@section('styles')
<link rel="stylesheet" href="{{ url('assets/css/estrellas.css') }}">
@endsection

@section('content')
<form method="post" action="{{ route('valoracion.update', $valoracion->id) }}">
    @csrf
    @method('put')
    <label for="comment">Comentario</label>
    <textarea class="form-control" minlength="20" id="comment" name="comment"
        placeholder="Comment for the hairstyle" cols="60" rows="3" >{{ old('comment', $valoracion->comment) }}</textarea>
    <p class="clasificacion">
        @for($i = 5; $i >= 1; $i--)
            <input id="radio{{ 5 - $i + 1 }}" type="radio" name="rate" value="{{ $i }}" @if(old('rate', $valoracion->rate) == $i) checked @endif>
            <label for="radio{{ 5 - $i + 1 }}">★</label>
        @endfor
    </p>
    <input class="btn btn-primary" value="Edit comentario" type="submit">
</form>
@endsection