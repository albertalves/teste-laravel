<?php

namespace App\Http\Controllers\Grupo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Pessoa;
use Illuminate\Support\Facades\Validator;

class GrupoController extends Controller
{
    // Autenticação de login
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Listando com o Elloquent
     */
    public function index()
    {
        $grupos = Grupo::paginate(5);   
        
        return view('grupo.index', [
            'grupos' => $grupos
        ]);
    }


    public function create()
    {
        return view('grupo.create');
    }


    public function store(Request $request)
    {
        // Recebendo os dados enviados
        $data = $request->only([
            'nome',
            'descricao'
        ]);
        // Validando os dados
        $validator = Validator::make($data, [
            'nome' => ['required', 'string', 'max:255'],
            'descricao' =>['required', 'string', 'max:500',]
        ]);
        // Retornando os erros caso houverem
        if ($validator->fails()) {
            return redirect()->route('grupo.create')
            ->withErrors($validator)
            ->withInput(); 
        }

        // Salvando as informações
        $grupo = new Grupo;
        $grupo->nome  = $data['nome'];
        $grupo->descricao = $data['descricao'];
        $grupo->save();

        return redirect()->route('grupo.index')
        ->with('success', 'Informações incluídas com sucesso!');
    }


    public function show($id)
    {
        // Retornando todos os participantes do grupo 
        $pessoas = Pessoa::where('grupo_id', $id)->get();

        // Retornando o nome do grupo
        $nomeGrupo = Grupo::where('id', $id)->get('nome');

        if($pessoas->count() > 0)
        {
            return view('grupo.show', [
                'pessoas' => $pessoas,
                'nomeGrupo' => $nomeGrupo['0']->nome
            ]);
        }
        return redirect()->route('grupo.index')
        ->with('warning', 'Nenhum participante no grupo!');
    }

    public function edit($id)
    {
        $grupo = Grupo::find($id);

        if ($grupo) 
        {
            return view('grupo.editar', [
                'grupo' => $grupo
            ]); 
        }
        
        return redirect()->route('grupo.index');
    }


    public function update(Request $request, $id)
    {
        $grupo = Grupo::find($id);

        if ($grupo) 
        {
            // Obtendo os dados enviados no formulario
            $data = $request->only([
                'nome', 
                'descricao'
            ]);

            // Verificando se os dados foram enviados
            $validator = Validator::make([
                'nome'  => $data['nome'],
                'descricao' => $data['descricao']
            ], [
                'nome' => ['required'],
                'descricao' => ['required']
            ]);

            // alterando os dados
            $grupo->nome = $data['nome'];
            $grupo->descricao = $data['descricao'];

        
            // Caso houve erro de validação
            if (count( $validator->errors() ) > 0) 
            {
                return redirect()->route('grupo.edit', [
                    'grupo' => $id
                ])->withErrors($validator);
            }
            $grupo->save();
        }
        
        return redirect()->route('grupo.index')
        ->with('success', 'Informações atualizadas com sucesso!');
    }


    public function destroy($id)
    {
        // Verifico se o grupo existe
        $grupo = Grupo::find($id);

        // Retornando todos os participantes do grupo 
        $pessoas = Pessoa::where('grupo_id', $id)->get();
        
        // Só deletar se não houver nenhum retorno
        if($pessoas->count() === 0)
        {
            // Caso exista, deletar
            if ($grupo->count() > 0){
                $grupo->delete();
                return redirect()->route('grupo.index')
                ->with('success', 'Deletado com sucesso!');
            }
        }
        // Se chegou até aqui, o usuário não existe.
        return redirect()->route('grupo.index');
    }
}
