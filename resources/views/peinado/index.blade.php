@extends('app.bootstrap.template')

@section('content')
<!-- ventanas modales principio -->

<div class="modal fade" id="destroyModal" tabindex="-1" aria-labelledby="destroyModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="destroyModalLabel">Confirm delete hairstyle</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="destroyModalContent"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button form="form-delete" type="submit" class="btn btn-primary">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- ventanas modales fin -->

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
                    <a class="link-destroy btn btn-danger btn-sm"
                        data-href="{{ route('peinado.destroy', $peinado->id) }}"
                        data-peinado="{{ $peinado->name }}">delete</a>
                    <a class="btn btn-danger btn-sm"
                        data-bs-target="#destroyModal"
                        data-bs-toggle="modal"
                        data-href="{{ route('peinado.destroy', $peinado->id) }}"
                        data-peinado="{{ $peinado->name }}">delete</a>
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

<form action="" method="post" id="form-delete">
    @csrf
    @method('delete')
</form>
@endsection