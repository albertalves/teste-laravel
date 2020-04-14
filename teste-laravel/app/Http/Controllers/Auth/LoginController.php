<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/painel';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {   
        // Recebendo os dados do formulario
        $data = $request->only([
            'email',
            'password'
        ]);

        // Validando os dados
        $validator = $this->validator($data);

        // Lembrar senha
        $remember = $request->input('remember', false);

        // // Caso houver erro
        if ($validator->fails()) {
            // retorno para a rota de registro
            return redirect()->route('login')
            // com a mensagem do erro no seu input.
            ->withErrors($validator)
            // exibindo as informações que foram preenchidos
            ->withInput();
        }

        // Se chegou aqui significa que passou pela primeira verificação
        // E então vamos tentar logar
        if (Auth::attempt($data, $remember)) {
            return redirect()->route('painel');
        }

        // Se chegou aqui, quer dizer que houve erro no login
        $validator->errors()->add('password', 'E-mail e/ou senha errados!');
        return redirect()->route('login')
        ->withErrors($validator)
        ->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:100'],
            'password' => ['required', 'string', 'min:4']
        ]);
    }
}
