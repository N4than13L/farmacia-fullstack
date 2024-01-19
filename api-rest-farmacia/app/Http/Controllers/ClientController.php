<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use App\Helpers\JwtAuth;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function test(Request $request)
    {
        return "controlador de clientes";
    }

    public function index(Request $request)
    {
        $token = $request->header("Authorization");
        $jwtAuth = new JwtAuth();
        $user = $jwtAuth->checkToken($token, true);

        $client = Client::all();

        foreach ($client as $clients) {
            // echo $clients->user->id;
            // echo $clients->user->name;
            // die();

            if ($clients->user_id === $user->sub) {
                return response()->json([
                    "status" => "success",
                    "code" => 200,
                    "user" => $user->name . " " . $user->surname,
                    'client' => $client
                ]);
            } else {
                return response()->json([
                    "status" => "error",
                    "code" => 404,
                    "error" => "no hay considencias",
                ]);
            }
        }
    }

    public function show(Request $request, $id)
    {
        $token = $request->header("Authorization");
        $jwtAuth = new JwtAuth();
        $user = $jwtAuth->checkToken($token, true);

        $client = Client::find($id);


        return response()->json([
            "status" => "success",
            "code" => 200,
            "user" => $user->name . " " . $user->surname,
            "client" => $client
        ]);
    }

    public function save(Request $request)
    {
        // recoger datos por post 
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
                'fullname' => 'required|alpha',
                'address' => 'required|alpha',
                'phone' => 'required|alpha',
                'user_id' => 'required' . $user->sub
            ]);

            // guardar cliente
            $client = new Client();
            $client->fullname = $params_array['fullname'];
            $client->address = $params_array['address'];
            $client->phone = $params_array['phone'];
            $client->user_id = $user->sub;

            $client->save();

            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "cliente guardado con exito",
                "user" => $user->name . " " . $user->surname,
                "client" => $client,
            );
        } else {
            $data = array(
                "status" => "error",
                "code" => 400,
                "message" => "Llena los datos correspondientes"
            );
        }

        // devolver resultado
        return response()->json($data, $data['code']);
    }

    public function update(Request $request, $id)
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

            $client = Client::find($id);

            // validar datos.
            $validate = Validator::make($params_array, [
                'fullname' => 'required|alpha',
                'address' => 'required|alpha',
                'phone' => 'required|alpha',
                'user_id' => 'required' . $user->sub
            ]);

            // actualizar datos de usuario
            $client_update = Client::where('id', $id)->update($params_array);

            // devolver array con el resultado
            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "datos actualizados con exito",
                "client" => $client,
                "changes" => $params_array,
                "user" => $user
            );
        } else {
            $data = array(
                "status" => "success",
                "code" => 500,
                "message" => "No se pueden actuaizar los datos del cliente"
            );
        }
        // delvolver respuesta.
        return response()->json($data, $data['code']);
    }
}
