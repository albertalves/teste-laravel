<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    // Autenticação de login
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Obtendo o Id do usuário que está logado
        $loggedId = Auth::id();
        // Retornando as informações desse usuário
        $user = User::find($loggedId);

        return view('admin.user', [
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($user) 
        {
            $data = $request->only([
                'name', 
                'email', 
                'password', 
                'password_confirmation'
            ]);
            $validator = Validator::make([
                'name'  => $data['name'],
                'email' => $data['email']
            ], [
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:100']
            ]);

            // 1. Alteração do nome
            $user->name = $data['name'];

            // 2. Alteração do e-mail
            if ($user->email != $data['email']) 
            {
                $hasEmail = User::where('email', $data['email'])->get();
                if ($hasEmail->count() === 0) 
                {
                    $user->email = $data['email'];
                }
                else
                {
                    $validator->errors()->add('email', __('validation.unique', [
                        'attribute' => 'email'
                    ]));
                }
            }

            // 3. Alteração da senha
            // Verifica se o usuario digitou senha
            if (!empty($data['password'])) 
            {
                // Validação da senha
                if (strlen($data['password']) >=4 ) 
                {
                    // Verifica se a confirmação está ok
                    if ($data['password'] === $data['password_confirmation']) 
                    {
                        // Altera a senha
                        $user->password = Hash::make($data['password']);
                    }
                    else
                    {
                        $validator->errors()->add('password', __('validation.confirmed', [
                            'attribute' => 'password'
                        ]));
                    }
                }
                else
                {
                    // Caso a senha não for validada, exibir erro.
                    $validator->errors()->add('password', __('validation.min.string', [
                        'attribute' => 'password',
                        'min' => 4
                    ]));
                }
            }

            if (count( $validator->errors() ) > 0) 
            {
                return redirect()->route('user.index')
                ->withErrors($validator);
            }
            $user->save();

        }
        
        return redirect()->route('user.index')
        ->with('warning', 'Informações alteradas com sucesso!');
    }

    public function show($id)
    {
        //
    }
}
