<?php

namespace App\Http\Controllers\Pessoa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Models\Grupo;
use Illuminate\Support\Facades\Validator;

class PessoaController extends Controller
{
    /**
     * Listando com o Elloquent
     */
    public function index()
    {
        $pessoas = Pessoa::paginate(10);   

        return view('participante.index', [
            'pessoas' => $pessoas
        ]);
    }

    public function create()
    {
        $grupos = Grupo::All();  
        return view('participante.create', [
            'grupos' => $grupos
        ]);
    }

    public function store(Request $request)
    {
        // Recebendo os dados enviados
        $data = $request->only([
            'grupo',
            'nome',
            'cpf',
            'cep',
            'uf',
            'cidade',
            'bairro',
            'logradouro',
            'numero',
            'complemento',
            'telefone',
            'telefone_2',
            'nacionalidade',
            'data_nascimento',
        ]);
        // Validando os dados
        $validator = Validator::make($data, [
            'nome' => ['required', 'string'],
            'cpf' =>['required', 'string', 'max:14'],
            'cep' =>['required', 'string', 'max:20'],
            'uf' =>['required', 'string', 'max:45'],
            'cidade' =>['required', 'string'],
            'bairro' =>['required', 'string'],
            'logradouro' =>['required', 'string'],
            'numero' =>['required', 'string'],
            'complemento' =>['string'],
            'telefone' =>['required', 'string', 'max:45'],
            'telefone_2' =>['required', 'string', 'max:45'],
            'nacionalidade' =>['required', 'string', 'max:45'],
            'data_nascimento' =>['required', 'date_format:d/m/Y']
        ]);
        // Retornando os erros caso houverem
        if ($validator->fails()) {
            return redirect()->route('participante.create')
            ->withErrors($validator)
            ->withInput(); 
        }

        // Converter data do padrão brasileiro para o padrão do banco de dados
        $novaData = array_reverse(explode("/", $data['data_nascimento']));
        $novaData = implode("-", $novaData);
        
        // Salvando as informações
        $pessoa = new Pessoa;
        $pessoa->nome            = $data['nome'];
        $pessoa->cpf             = $data['cpf'];
        $pessoa->cep             = $data['cep'];
        $pessoa->uf              = $data['uf'];
        $pessoa->cidade          = $data['cidade'];
        $pessoa->bairro          = $data['bairro'];
        $pessoa->logradouro      = $data['logradouro'];
        $pessoa->numero          = $data['numero'];
        $pessoa->complemento     = $data['complemento'];
        $pessoa->telefone        = $data['telefone'];
        $pessoa->telefone_2      = $data['telefone_2'];
        $pessoa->nacionalidade   = $data['nacionalidade'];
        $pessoa->data_nascimento = $novaData;
        $pessoa->grupo_id        = $data['grupo'];
        $pessoa->save();

        return redirect()->route('participante.index')
        ->with('warning', 'Incluído com sucesso!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $pessoa = Pessoa::find($id);
        $grupos = Grupo::All();  

        // Converter do banco para o padrão brasileiro
        $novaData = array_reverse(explode("-", $pessoa->data_nascimento));
        $novaData = implode("/", $novaData);
        
        $data['pessoa']   = $pessoa;
        $data['grupos']   = $grupos;
        $data['novaData'] = $novaData;

        if ($pessoa) 
        {
            return view('participante.editar', $data); 
        }
        
        return redirect()->route('participante.index');
    }


    public function update(Request $request, $id)
    {
        $pessoa = Pessoa::find($id);

        if($pessoa)
        {
            // Recebendo os dados enviados
            $data = $request->only([
                'grupo',
                'nome',
                'cpf',
                'cep',
                'uf',
                'cidade',
                'bairro',
                'logradouro',
                'numero',
                'complemento',
                'telefone',
                'telefone_2',
                'nacionalidade',
                'data_nascimento',
            ]);
            // Validando os dados
            $validator = Validator::make($data, [
                'nome' => ['required', 'string'],
                'cpf' =>['required', 'string', 'max:14'],
                'cep' =>['required', 'string', 'max:20'],
                'uf' =>['required', 'string', 'max:45'],
                'cidade' =>['required', 'string'],
                'bairro' =>['required', 'string'],
                'logradouro' =>['required', 'string'],
                'numero' =>['required', 'string'],
                'complemento' =>['string'],
                'telefone' =>['required', 'string', 'max:45'],
                'telefone_2' =>['required', 'string', 'max:45'],
                'nacionalidade' =>['required', 'string', 'max:45'],
                'data_nascimento' =>['required', 'date_format:d/m/Y']
            ]);
            // Retornando os erros caso houverem
            if ($validator->fails()) {
                return redirect()->route('participante.create')
                ->withErrors($validator)
                ->withInput(); 
            }

            // Converter data do padrão brasileiro para o padrão do banco de dados
            $novaData = array_reverse(explode("/", $data['data_nascimento']));
            $novaData = implode("-", $novaData);
            
            // Salvando as informações
            $pessoa->nome            = $data['nome'];
            $pessoa->cpf             = $data['cpf'];
            $pessoa->cep             = $data['cep'];
            $pessoa->uf              = $data['uf'];
            $pessoa->cidade          = $data['cidade'];
            $pessoa->bairro          = $data['bairro'];
            $pessoa->logradouro      = $data['logradouro'];
            $pessoa->numero          = $data['numero'];
            $pessoa->complemento     = $data['complemento'];
            $pessoa->telefone        = $data['telefone'];
            $pessoa->telefone_2      = $data['telefone_2'];
            $pessoa->nacionalidade   = $data['nacionalidade'];
            $pessoa->data_nascimento = $novaData;
            $pessoa->grupo_id        = $data['grupo'];
            $pessoa->save();

            return redirect()->route('participante.index')
            ->with('warning', 'Atualizado com sucesso!');
        }
        return redirect()->route('participante.index');
    }

    public function destroy($id)
    {
        // Verifico se o usuário existe
        $pessoa = Pessoa::find($id);

        // Caso exista, deletar
        if ($pessoa){
            $pessoa->delete();
            return redirect()->route('participante.index')
            ->with('warning', 'Deletado com sucesso!');
        }
        // Se chegou até aqui, o participante não existe.
        return redirect()->route('participante.index');
    }
}
