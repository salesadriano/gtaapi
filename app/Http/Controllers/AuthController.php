<?php

namespace App\Http\Controllers;

use App\UsuarioSistema;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * @group Login Acesso
 */
class AuthController extends Controller
{
    /**
     * Instânçia do REQUEST
     *
     * @var \Illuminate\Http\Request
     */
    private $request;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $tmp = new UsuarioSistema();
        parent::__construct($tmp);
        $this->request = $request;
        $this->middleware('jwt.auth', ['only' => ['refreshToken']]);
    }

    /**
     * Atualiza o token.
     */
    public function refreshToken()
    {
        //Token enviado
        $token = $this->request->header('Authorization');
        //Payload do TOKEN
        $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        //Usuário do TOKEN
        $user = User::find($credentials->sub);

        return response()->json(['token' => $this->jwt($user)], 200);
    }

    /**
     * Cria o TOKEN JWT
     *
     * @param  \App\User $user
     * @return string
     */
    protected function jwt(UsuarioSistema $user)
    {
        $payload = [
            'iss' => getenv('APP_URL'), // Issuer do TOKEN. *TODO Mudar para o endereço real do servidor
            'sub' => $user->idUsuarioSistema, // Subject do TOKEN.
            'user' => $user->nomeUsuarioSistema, // Nome do usuário.
            'iat' => time(), // Hora da emissão do TOKEN.
            'exp' => time() + 60 * 60, // Hora de exporiração do TOKEN.
        ];
        // As you can see we are passing `JWT_SECRET` as the second parameter that will
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    }

    /**
     * Login no Sistema
     *
     * <aside class="notice">Autentica usuario na API.</aside>
     *
     * @queryParam loginUsuarioSistema string required <b>Login do usuario</b>
     * @queryParam senhaUsuarioSistema string required <b>Senha do usuario</b>
     *
     * @responseField idUsuarioSistema integer ID do registro no bando de dados
     * @responseField idPessoa integer ID da pessoa assiciado ao usuario
     * @responseField nomeUsuarioSistema string Nome completo do usuario
     * @responseField emailUsuarioSistema string E-mail do usuario
     * @responseField situacaoUsuarioSistema integer Situacao do usuario
     * @responseField token string Token de autorização do usuario
     *
     * @response 200 {
     * "idUsuarioSistema": 1,
     * "idPessoa": null,
     * "nomeUsuarioSistema": "Usuario",
     * "emailUsuarioSistema": "usuario@email.com",
     * "situacaoUsuarioSistema": "ATIVO",
     * "remember_token": null,
     * "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.* eyJpc3MiOiJodHRwOlwvXC9ndGFhcGkubWFjc29sdWNvZXMuY29tIiwic3ViIjoxLCJ1c2VyIjoiQWRyaWFubyBTYWxlcyBTYW50b3MiLCJpYXQiOjE2MTAxMzU3NDEsImV4cCI6MTYxMDEzOTM0MX0.* 2gHZwAHqY5CHKENYVR_WU0Zk8LndeQ0LUkcFf7pKhMo"
     *
     * @group Login Acesso
     *
     */
    public function login(UsuarioSistema $user)
    {
        $this->validate($this->request, [
            'loginUsuarioSistema' => 'required',
            'senhaUsuarioSistema' => 'required',
        ], [
            'loginUsuarioSistema.required' => 'Login obrigatorio.',
            'senhaUsuarioSistema.required' => 'Senha obrigatoria.',
        ]);
        // Encontra o usuario pelo e-mail
        $user = UsuarioSistema::where('loginUsuarioSistema', $this->request->input('loginUsuarioSistema'))->first();
        if (!$user) {
            return response()->json([
                'error' => 'Usuario nao cadastrado.',
            ], 401);
        }

        // Verifica a senha e gera o TOKEN
        if (Hash::check($this->request->input('senhaUsuarioSistema'), $user->senhaUsuarioSistema)) {
            $user->token = $this->jwt($user);
            return response()->json([$user], 200);
        }
        // BAD REQUEST response
        return response()->json([
            'error' => 'Senha inválida.',
        ], 401);
    }
}
