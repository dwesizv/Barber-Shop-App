@extends('app.bootstrap.template')

@section('content')

<form action="{{ route('peinado.update', $peinado->id) }}" method="post">
    @csrf
    @method('put')
    <div class="espacio">
        <label for="author">Author:</label>
        <input class="form-control" minlength="2" maxlength="60" required id="author" name="author" placeholder="Author of the hairstyle" value="{{ old('author', $peinado->author) }}" type="text">
    </div>
    <div class="espacio">
        <label for="name">Name:</label>
        <input class="form-control" minlength="3" maxlength="100" required id="name" name="name" placeholder="Name of the hairstyle" value="{{ old('name', $peinado->name) }}" type="text">
    </div>
    <div class="espacio">
        <label for="hair">Type of hair</label>
        <input class="form-control" minlength="3" maxlength="110" required id="hair" name="hair" placeholder="Type of hair for the hairstyle" value="{{ old('hair', $peinado->hair) }}" type="text">
    </div>
    <div class="espacio">
        <label for="description">Description of the hairstyle</label>
        <textarea class="form-control" minlength="50" required id="description" name="description" placeholder="Description of the hairstyle" cols="60" rows="8" >{{ old('description', $peinado->description) }}</textarea>
    </div>
    <div class="espacio">
        <label for="price">Price of the hairstyle</label>
        <input class="form-control" step="0.01" min="0" max="999999.99" required id="price" name="price" placeholder="Price of the hairstyle" value="{{ old('price', $peinado->price) }}" type="number">
    </div>
    <div class="espacio">
        <input class="btn btn-primary" value="Edit hairstyle" type="submit">
    </div>
</form>

@endsection