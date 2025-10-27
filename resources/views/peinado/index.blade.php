@extends('app.bootstrap.template')

@section('content')



<hr>

<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Author</th>
            <th>Name</th>
            <th>
                Actions
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($peinados as $peinado)
            <tr>
                <td>{{ $peinado->id }}</td>
                <td>{{ $peinado->author }}</td>
                <td>{{ $peinado->name }}</td>
                <td>
                    <a href="{{ route('peinado.show', $peinado->id) }}" class="btn btn-success btn-sm">show</a>
                    <a href="{{ route('peinado.edit', $peinado->id) }}" class="text-white btn btn-warning btn-sm">edit</a>
                    <a href="{{ route('peinado.destroy', $peinado->id) }}" class="btn btn-danger btn-sm">delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">Número de peinados:</th>
            <th>{{ count($peinados) }}</th>
        </tr>
    </tfoot>
</table>

<form action="{{ route('peinado.destroy', $peinado->id) }}" method="post">
    @csrf
    @method('delete')
    <input class="btn btn-primary" value="Delete hairstyle" type="submit">
</form>

@endsection