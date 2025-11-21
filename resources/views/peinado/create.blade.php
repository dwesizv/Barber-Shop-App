@extends('app.bootstrap.template')

@section('content')
<form action="{{ route('peinado.store') }}" method="post" enctype="multipart/form-data"><!-- es la única forma de poder subir un archivo -->
    @csrf
    <div class="espacio">
        @error('author')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="author">Author:</label>
        <input class="form-control" minlength="1" maxlength="60" required id="author" name="author" placeholder="Author of the hairstyle" value="{{ old('author') }}" type="text">
    </div>
    <div class="espacio">
        <label for="name">Name:</label>
        <input class="form-control" minlength="3" maxlength="100" required id="name" name="name" placeholder="Name of the hairstyle" value="{{ old('name') }}" type="text">
    </div>
    <div class="espacio">
        <label for="hair">Type of hair</label>
        <input class="form-control" minlength="3" maxlength="110" required id="hair" name="hair" placeholder="Type of hair for the hairstyle" value="{{ old('hair') }}" type="text">
    </div>
    <div class="espacio">
        <label for="description">Description of the hairstyle</label>
        <textarea class="form-control" minlength="50" required id="description" name="description" placeholder="Description of the hairstyle" cols="60" rows="8" >{{ old('description') }}</textarea>
    </div>
    <div class="espacio">
        @error('price')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="price">Price of the hairstyle</label>
        <input class="form-control" step="0.01" min="-1" max="999999.99" required id="price" name="price" placeholder="Price of the hairstyle" value="{{ old('price') }}" type="number">
    </div>
    <div class="espacio">
        @error('image')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="image">Picture of the hairstyle</label>
        <input class="form-control" id="image" name="image" type="file" accept="image/*">
        <!-- <p>
            Sugerencias:
            <ul>
                <li>mostrar vista previa de la imagen seleccionada</li>
                <li>permitir arrastrar la imagen sobre el formulario o un área del formulario</li>
                <li>'ocultar' el input type file</li>
            </ul>
        </p>-->
    </div>
    <div class="espacio">
        <label for="pdf">Portfolio of the hairstyle</label>
        <input class="form-control" id="pdf" name="pdf" type="file" accept="application/pdf">
    </div>
    <div class="espacio">
        <input class="btn btn-primary" value="Add new hairstyle" type="submit">
    </div>
</form>

@endsection