@extends('adminlte::page')

@section('title', 'Configurações')

@section('content')
    <div class="card">
    <div class="card-header">
        <h4>Editar</h4>
    </div>
      <div class="card-body">
        <form action="{{ route('user.update', ['user'=>$user->id]) }}" method="POST" class="form-horizontal">
          @method('PUT')
          @csrf
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
                <input type="text" name="name" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">E-mail</label>
            <div class="col-sm-10">
                <input type="email" name="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror" />
            </div>
        </div>
        <div class="form-group row"> 
            <label class="col-sm-2 col-form-label">Nova Senha</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Confirmar Senha</label>
            <div class="col-sm-10">
                <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <input type="submit" value="Salvar" class="btn btn-success" />
            </div>
        </div>
        </form>
      </div>
    </div>
    @if (session('warning'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-check"></i>
            {{session('warning')}}
        </div>
    @endif
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




