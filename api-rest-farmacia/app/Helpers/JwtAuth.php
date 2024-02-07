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
            'email' => $email
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
                'iat' => time(),
                'exp' => time() + (7 * 24 * 60 * 60)
            );

            // Devolver datos decodificados
            $jwt = JWT::encode($token, $this->key, 'HS256');
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);

            if (is_null($getToken)) {
                $data = array(
                    "status" => "success",
                    "code" => 200,
                    "token" => $jwt,
                    "user" => $user
                );
            } else {
                $data = array(
                    "status" => "success",
                    "code" => 200,
                    "token" => $decoded
                );
            }
        } else {
            $data = array(
                'status' => 'error',
                'message' => 'Login Incorecto'
            );
        }

        return $data;
    }

    public function checkToken($jwt, $getIdentity = false)
    {
        $auth = false;

        try {
            $jwt = str_replace('"', "", $jwt);
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);
        } catch (\UnexpectedValueException $ex) {
            $auth = false;
        } catch (\DomainException $ex) {
            $auth = false;
        }

        if (!empty($decoded) && is_object($decoded) && isset($decoded->sub)) {
            $auth = true;
        } else {
            $auth = false;
        }

        if ($getIdentity) {
            return $decoded;
        }

        return $auth;
    }
}
