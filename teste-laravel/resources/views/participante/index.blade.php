@extends('adminlte::page')

@section('title', 'Listar participante')

@section('content')
<div class="card">
  <div class="card-header">
    <h1>Listar participantes</h1>
  </div>
  <div class="card-body">
    <table class="table table-hover">
      <thead>
          <tr>
              <th>Nome</th>
              <th>Cidade</th>
              <th>Bairro</th>
              <th>Logradouro</th>
              <th>Ações</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($pessoas as $item)
              <tr>
                  <td>{{$item->nome}}</td>
                  <td>{{$item->cidade}}</td>
                  <td>{{$item->bairro}}</td>
                  <td>{{$item->logradouro}}</td>
                  <td>
                    <a href="{{ route('participante.edit', $item->id) }}" class="btn btn-sm btn-info">Editar</a>

                    <form class="d-inline" method="POST" action="{{ route('participante.destroy', $item->id) }}" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                        @method('DELETE')
                        @csrf
                    <button class="btn btn-sm btn-danger" >Excluir</button>
                    </form>
                  </td>
              </tr>
          @endforeach
      </tbody>
  </table>
  </div>
</div>
{{ $pessoas->links() }}
@if (session('warning'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <i class="icon fas fa-check"></i>
    {{session('warning')}}
</div>
@endif
@endsection
