<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Iliminate\Support\Facades\DB;
use App\Models\User;

class JwtAuth
{

    public $key;
    public function __construct()
    {
        $this->key = 'algo_que_no_se-67654';
    }

    public function signup($email, $password, $getToken = null)
    {
        // Buscar si existe el usuario con sus credenciales.
        $user = User::where([
            'email' => $email,
            'password' => $password
        ])->first();

        // Comprobando si las mismas son correctas.
        $signup = false;
        if (is_object($user)) {
            $signup = true;
        }

        // Generar el token con los datos del usuario.
        if ($signup) {
            $token = array(
                'sub' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'surname' => $user->surname,
                "description" => $user->description,
                "image" => $user->image,
                'iat' => time(),
                'exp' => time() + (7 * 24 * 60 * 60)
            );

            // Devolver datos decodificados
            $jwt = JWT::encode($token, $this->key, 'HS256');
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);

            if (is_null($getToken)) {
                $data = $jwt;
            } else {
                $data = $decoded;
            }
        } else {
            $data = array(
                'status' => 'error',
                'message' => 'Login Incorecto'
            );
        }

        return $data;
    }
}
