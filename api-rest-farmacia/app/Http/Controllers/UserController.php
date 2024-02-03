<?php

namespace App\Http\Controllers;

use App\Helpers\JwtAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function test(Request $request)
    {
        return "controlador de usuarios";
    }

    public function register(Request $request)
    {
        // recoger datos de entrada del usuario
        $name = $request->input("name");
        $surname = $request->input("surname");
        $email = $request->input("email");
        $password = $request->input("password");

        if (!empty($name) && !empty($surname) && !empty($email) && !empty($password)) {
            // cifrar la contrasena
            $pwd = hash("sha256", $password);

            // crear el usuario
            $user = new User();

            $user->name = $name;
            $user->surname = $surname;
            $user->email = $email;
            $user->password = $pwd;
            $user->role = "User";

            // guardar usuario
            $user->save();

            // devolver respuesta
            $data  = array(
                "status" => "success",
                "code" => 200,
                "message" => "Usuario guardado con exito",
                "user" => $user
            );
        } else {
            //  devolver respuesta
            $data  = array(
                "status" => "error",
                "code" => 400,
                "message" => "Lo siento no se pudo registrar el usuario",
            );
        }


        // devolver respuesta. 

        return response()->json($data,  $data['code']);
    }

    public function login(Request $request)
    {
        $jwtAuth = new JwtAuth();

        // Recibir los datos por POST.
        $email = $request->input("email");
        $password = $request->input("password");


        if (empty($email) && empty($password)) {
            // Error al enviar los datos 
            $signup = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Usuario no ha podido hacer el login',
            );
        } else {
            // Cifrar la contrasena.
            $pwd = $password;

            // Devolver los datos del token.
            $signup = $jwtAuth->signup($email, $pwd);

            if (!empty($pwd->gettoken)) {
                $signup = $jwtAuth->signup($email, $pwd, true);
            }
        }

        return response()->json($signup, 200);
    }

    public function update(Request $request)
    {
        // recoger token por la cabezera
        $token = $request->header("Authorization");
        $jwtAuth = new JwtAuth();

        // sacar datos del usuario identificado via token
        $checkToken = $jwtAuth->checkToken($token);

        // Recibir los datos por POST.
        // $json = $request->input('json', null);
        // $params_array = json_decode($json, true);

        $name = $request->input("name");
        $surname = $request->input("surname");
        $email = $request->input("email");
        // $password = $request->input("password");



        if ($checkToken && !empty($name) || !empty($surname) || !empty($email)) {

            // recoger datos por post.
            $jwtAuth = new JwtAuth();

            $user = $jwtAuth->checkToken($token, true);
            $user_changes = User::find($user->sub);

            // quitar campos que no se nesecitan.
            unset($user->role);
            unset($user->password);
            unset($user->created_at);
            unset($user->remember_token);

            // actualizar datos de usuario
            DB::table('user')
                ->where('id', $user->sub)
                ->update([
                    'name' => $name,
                    'surname' => $surname,
                    'email' => $email,
                ]);

            // devolver array con el resultado
            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "datos actualizados con exito",
                "user" => $user,
                'changes' => $user_changes
            );
        } else {
            $data = array(
                "status" => "success",
                "code" => 500,
                "message" => "No se pueden actuaizar los datos, intente más tarde"
            );
        }

        return response()->json($data, $data['code']);
    }

    public function profile($id)
    {
        $user = User::find($id);

        if (is_object($user)) {
            $data = array(
                "status" => "success",
                "code" => 200,
                "user" => $user
            );
        } else {
            $data = array(
                "status" => "error",
                "code" => 404,
                "message" => "Datos no coinciden"
            );
        }

        return response()->json($data, $data['code']);
    }
}
