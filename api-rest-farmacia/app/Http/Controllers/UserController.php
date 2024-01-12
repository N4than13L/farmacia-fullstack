<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function test(Request $request)
    {
        return "controlador de usuarios";
    }

    public function register(Request $request)
    {
        // recoger datos del usuario por post
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        // validar datos por post
        $validate = Validator::make($params_array, [
            'name' => 'required|alpha',
            'surname' => 'required|alpha',
            // comprobar si el usuario existe (duplicado)
            'email' => 'required|email|unique:user',
            'password' => 'required',
        ]);

        // solo para rellenar de forma automatica 'role' => 'employer'

        if (!empty($params)) {
            // limpiar datos.
            $params_array = array_map("trim", $params_array);

            if ($validate->fails()) {
                $data  = array(
                    "status" => "error",
                    "code" => 400,
                    "message" => "no guardados, favor inserte correctamente",
                    "errors" => $validate->errors()
                );

                return response()->json($data,  $data['code']);
            } else {
                $data  = array(
                    "status" => "success",
                    "code" => 200,
                    "message" => "usuario guardado con exito",
                );

                // cifrar la contrasena
                $pwd = password_hash($params->password, PASSWORD_BCRYPT, ['cost' => 4]);

                // crear el usuario
                $user = new User();
                $user->name = $params_array['name'];
                $user->surname = $params_array['surname'];
                $user->email = $params_array['email'];
                $user->password = $pwd;
                $user->role = "Employer";

                // guardar usuario
                $user->save();

                // var_dump($user);
                // die();

                // devolver respuesta
                $data  = array(
                    "status" => "success",
                    "code" => 200,
                    "message" => "datos sacados con exito",
                    "user" => $user
                );

                return response()->json($data,  $data['code']);
            }
        } else {
            $data  = array(
                "status" => "error",
                "code" => 400,
                "message" => "error al guardar datos",
            );
        }

        return response()->json($data,  $data['code']);
    }

    public function login(Request $request)
    {
        return "Login de usuarios";
    }
}
