@extends('adminlte::page')

@section('title', 'Novo Grupos')

@section('content')
<div class="card">
  <div class="card-header">
      <h4>Novo Grupo</h4>
  </div>
  <div class="card-body">
      <form action="{{ route('grupo.store') }}" method="POST" class="form-horizontal">
          @csrf
          <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nome</label>
              <div class="col-sm-10">
                  <input type="text" name="nome" value="{{old('nome')}}" class="form-control @error('nome') is-invalid @enderror" />
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-2 col-form-label">Descrição</label>
              <div class="col-sm-10">
                  <input type="text" name="descricao" value="{{old('descricao')}}" class="form-control @error('descricao') is-invalid @enderror" />
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                  <input type="submit" value="Cadastrar" class="btn btn-success" />
              </div>
          </div>
      </form>
  </div>
</div>
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5>
            <i class="icon fas fa-ban"></i>
            Ooops!
        </h5>
        @foreach ($errors->all() as $error)
            <span>{{$error}}</span>
        @endforeach
    </div>
    @endif
@endsection