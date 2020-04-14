@extends('adminlte::page')

@section('title', 'Cadastrar participante')

@section('content')
<div class="card">
  <div class="card-header">
      <h4>Novo Parcipante</h4>
  </div>
  <div class="card-body">
      <form action="{{ route('participante.store') }}" method="POST" class="form-horizontal">
          @csrf
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Grupo:</label>
            <div class="col-sm-10">
                <select name="grupo" class="form-control" required>
                    <option>Selecione um grupo...</option>
                    @foreach ($grupos as $item)
                    <option value=" {{ $item['id'] }} ">
                        {{ $item['nome'] }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
          <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nome:</label>
                <div class="col-sm-10">
                    <input type="text" name="nome" value="{{old('nome')}}"class="form-control 
                    @error('nome') is-invalid @enderror" placeholder="Nome"/>
                </div>
          </div>
          <div class="form-group row">
                <label class="col-sm-2 col-form-label">CPF:</label>
                <div class="col-sm-10">
                    <input type="text" name="cpf" value="{{old('cpf')}}" class="cpf form-control 
                    @error('cpf') is-invalid @enderror" placeholder="000.000.000-00"/>
                </div>
          </div>
          <div class="form-group row">
                <label class="col-sm-2 col-form-label">CEP:</label>
                <div class="col-sm-10">
                    <input type="text" name="cep" value="{{old('cep')}}" class="cep form-control 
                    @error('cep') is-invalid @enderror" placeholder="00000-000"/>
                </div>
          </div>
          <div class="form-group row">
                <label class="col-sm-2 col-form-label">UF:</label>
                <div class="col-sm-10">
                    <input type="text" name="uf" maxlength="2" value="{{old('uf')}}" class="form-control 
                    @error('uf') is-invalid @enderror" placeholder="UF"/>
                </div>
          </div>
          <div class="form-group row">
                <label class="col-sm-2 col-form-label">Cidade:</label>
                <div class="col-sm-10">
                    <input type="text" name="cidade" value="{{old('cidade')}}" class="form-control 
                    @error('cidade') is-invalid @enderror" placeholder="Cidade"/>
                </div>
          </div>
          <div class="form-group row">
                <label class="col-sm-2 col-form-label">Bairro:</label>
                <div class="col-sm-10">
                    <input type="text" name="bairro" value="{{old('bairro')}}" class="form-control 
                    @error('bairro') is-invalid @enderror" placeholder="Bairro"/>
                </div>
          </div>
          <div class="form-group row">
                <label class="col-sm-2 col-form-label">Logradouro:</label>
                <div class="col-sm-10">
                    <input type="text" name="logradouro" value="{{old('logradouro')}}" class="form-control 
                    @error('logradouro') is-invalid @enderror" placeholder="Digite seu endereço"/>
                </div>
          </div>
          <div class="form-group row">
                <label class="col-sm-2 col-form-label">Numero:</label>
                <div class="col-sm-10">
                    <input type="text" name="numero" value="{{old('numero')}}" class="form-control 
                    @error('numero') is-invalid @enderror" placeholder="Digite o numero da sua rua"/>
                </div>
          </div>
          <div class="form-group row">
                <label class="col-sm-2 col-form-label">Complemento:</label>
                <div class="col-sm-10">
                    <input type="text" name="complemento" value="{{old('complemento')}}" 
                    class="form-control @error('complemento') is-invalid @enderror" placeholder="Digite um complemento"/>
                </div>
          </div>
          <div class="form-group row">
                <label class="col-sm-2 col-form-label">Telefone:</label>
                <div class="col-sm-10">
                    <input type="text" name="telefone" value="{{old('telefone')}}" class="tel form-control 
                    @error('telefone') is-invalid @enderror" placeholder="(00) 00000-0000"/>
                </div>
          </div>
          <div class="form-group row">
                <label class="col-sm-2 col-form-label">Telefone 2:</label>
                <div class="col-sm-10">
                    <input type="text" name="telefone_2" value="{{old('telefone_2')}}" class="tel form-control 
                    @error('telefone_2') is-invalid @enderror" placeholder="(00) 00000-0000"/>
                </div>
          </div>
          <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nacionalidade:</label>
                <div class="col-sm-10">
                    <input type="text" name="nacionalidade" value="{{old('nacionalidade')}}" class="form-control 
                    @error('nacionalidade') is-invalid @enderror" placeholder="Nacionalidade"/>
                </div>
          </div>
          <div class="form-group row">
                <label class="col-sm-2 col-form-label">Data de Nascimento:</label>
                <div class="col-sm-10">
                    <input type="text" name="data_nascimento" value="{{old('data_nascimento')}}" class="data_nasc form-control 
                    @error('data_nasc') is-invalid @enderror" placeholder="00/00/0000"/>
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

@section('js')
    <script type='text/javascript' src='//igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js'></script>
    <script>
        $('.cpf').mask('000.000.000-00', {reverse: false});
        $('.cep').mask('00000-000', {reverse: false});
        $('.data_nasc').mask('00/00/0000', {reverse: false});
        $('.tel').mask('(00) 00000-0000', {reverse: false});
      </script>
@endsection