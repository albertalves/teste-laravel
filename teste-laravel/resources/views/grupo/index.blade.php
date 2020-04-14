@extends('adminlte::page')

@section('title', 'Listar Grupos')

@section('content_header')
    <a href="{{ route('grupo.create') }}" class="btn btn-success">Novo Grupo</a>
@endsection

@section('content')
  <div class="card">
    <div class="card-header">
        <h4>Listar Grupos</h4>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grupos as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->nome}}</td>
                        <td width="600">{{$item->descricao}}</td>
                        <td>
                            <a href="{{ route('grupo.edit', $item->id) }}" 
                                title="editar grupo" class="btn btn-sm btn-info">Editar</a>

                            <form class="d-inline" method="POST" action="{{ route('grupo.destroy', ['grupo' => $item->id]) }}" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-sm btn-danger" title="deletar grupo">Excluir</button>
                            </form>
                            
                            <a href="{{ route('grupo.show', $item->id) }}" title="ver todos os participantes" class="btn btn-sm btn-secondary">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
  {{ $grupos->links() }}
    @if (session('warning'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{session('warning')}}
    </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fas fa-check"></i>
        {{session('success')}}
    </div>
    @endif
@endsection