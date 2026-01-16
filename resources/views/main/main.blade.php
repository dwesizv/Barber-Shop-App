@extends('app.bootstrap.template')

@section('modalcontent')
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="orderModalLabel">Ordenar peinados por ...</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul>
            <li>
                <a class="btn btn-link mb-2"
                    href="{{ route('main', ['field' => 1, 'order' => 2]) }}">
                    Los peinados más recientes
                </a>
            </li>
            <li>
                <a class="btn btn-link mb-2"
                    href="{{ route('main', ['field' => 1, 'order' => 1]) }}">
                    Los peinados más antiguos
                </a>
            </li>
            <li>
                <a class="btn btn-link mb-2"
                    href="{{ route('main', ['field' => 2, 'order' => 1]) }}">
                    Los peinados más baratos
                </a>
            </li>
            <li>
                <a class="btn btn-link mb-2"
                    href="{{ route('main', ['field' => 2, 'order' => 2]) }}">
                    Los peinados más caros
                </a>
            </li>
            <li>
                <a class="btn btn-link mb-2"
                    href="{{ route('main', ['field' => 3, 'order' => 1]) }}">
                    Tipo de pelo ordenado de la 'a' la 'z'
                </a>
            </li>
            <li>
                <a class="btn btn-link mb-2"
                    href="{{ route('main', ['field' => 3, 'order' => 2]) }}">
                    Tipo de pelo ordenado de la 'z' a la 'a'
                </a>
            </li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="container px-4 py-5" id="custom-cards">
    <h2 class="pb-2 border-bottom">Peinados: @yield('tipopelo')</h2>
    <div>
        <a class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#orderModal">Ordenar por ...</a>
    </div>
    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
        @foreach($peinados as $peinado)
            <div class="col">
                <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg"
                    style="background-image: url('{{ $peinado->getPath() }}');">
                    <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                        <a style="text-decoration: none; color: white;" href="{{ route('peinado.show', $peinado->id) }}">
                            <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">{{ $peinado->name }}</h3>
                        </a>
                        <ul class="d-flex list-unstyled mt-auto">
                            <li class="me-auto">
                                <img src="https://github.com/twbs.png" alt="Bootstrap" width="32"
                                    height="32" class="rounded-circle border border-white">
                            </li>
                            <li class="d-flex align-items-center me-3">
                                <svg class="bi me-2" width="1em" height="1em"
                                    role="img" aria-label="Location">
                                    <use xlink:href="#geo-fill"></use>
                                </svg>
                                <small>{{ $peinado->author }}</small>
                            </li>
                            <li class="d-flex align-items-center"> <svg class="bi me-2" width="1em" height="1em"
                                    role="img" aria-label="Duration">
                                    <use xlink:href="#calendar3"></use>
                                </svg>
                                <a style="text-decoration: none; color: white;" href="{{ route('peinado.pelo', $peinado->idpelo) }}">
                                    <small>{{ $peinado->pelo->name }}</small>
                                </a>
                                id: {{ $peinado->id }} price: {{ $peinado->price }} idpelo: {{ $peinado->idpelo }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@if($hasPagination)
    <div class="row">
        {{ $peinados->onEachSide(2)->links() }}
    </div>
@endif

<!--<div class="row">
    <nav>
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="" rel="prev" aria-label="« Previous">‹</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="" rel="next" aria-label="Next »">›</a>
            </li>
        </ul>
    </nav>
</div>-->

@endsection