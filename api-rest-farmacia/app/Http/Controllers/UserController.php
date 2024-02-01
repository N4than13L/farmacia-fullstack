<?php

namespace App\Http\Controllers;

use App\Helpers\JwtAuth;
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
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        // Validar esos datos.
        $validate = Validator::make($params_array, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            // Error al enviar los datos 
            $signup = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Usuario no ha podido hacer el login',
                'errors' => $validate->errors()
            );
        } else {
            // Cifrar la contrasena.
            $pwd = $params->password;

            // Devolver los datos del token.
            $signup = $jwtAuth->signup($params->email, $pwd);

            if (!empty($params->gettoken)) {
                $signup = $jwtAuth->signup($params->email, $pwd, true);
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
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        if ($checkToken && !empty($params_array)) {

            // recoger datos por post.
            $jwtAuth = new JwtAuth();

            $user = $jwtAuth->checkToken($token, true);

            // validar datos.
            $validate = Validator::make($params_array, [
                'name' => 'required|alpha',
                'surname' => 'required|alpha',
                'email' => 'required|email|unique:user,' . $user->sub
            ]);

            // quitar campos que no se nesecitan.
            unset($params_array['id']);
            unset($params_array['role']);
            unset($params_array['password']);
            unset($params_array['created_at']);
            unset($params_array['remember_token']);

            // actualizar datos de usuario
            $user_update = User::where('id', $user->sub)->update($params_array);

            // devolver array con el resultado
            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "datos actualizados con exito",
                "user" => $user,
                "changes" => $params_array
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
                $user
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
