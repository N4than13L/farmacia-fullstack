<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Helpers\JwtAuth;
use Illuminate\Support\Facades\DB;

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
        $fullname = $request->input("fullname");
        $address = $request->input("address");
        $phone = $request->input("phone");

        if ($checkToken && !empty($fullname) || !empty($address) || !empty($phone)) {
            // recoger datos por post.
            $jwtAuth = new JwtAuth();

            $user = $jwtAuth->checkToken($token, true);

            // guardar cliente
            $client = new Client();
            $client->fullname = $fullname;
            $client->address = $address;
            $client->phone = $phone;
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
        $fullname = $request->input("fullname");
        $address = $request->input("address");
        $phone = $request->input("phone");

        if ($checkToken && !empty($fullname) || !empty($address) || !empty($phone)) {

            // recoger datos por post.
            $jwtAuth = new JwtAuth();

            $user = $jwtAuth->checkToken($token, true);

            $client = Client::find($id);
            $old = Client::find($id);

            // actualizar datos de usuario
            DB::table('clients')
                ->where('id', $id)
                ->update([
                    'fullname' => $fullname,
                    'address' => $address,
                    'phone' => $phone,
                ]);

            // devolver array con el resultado
            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "datos actualizados con exito",
                "client" => $client,
                "old" => $old,
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
