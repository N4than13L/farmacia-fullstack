<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use App\Helpers\JwtAuth;


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

        // var_dump($client);
        // die();

        if (isset($client) && isset($user->sub)) {
            return response()->json([
                "status" => "success",
                "code" => 200,
                "created_by" => $user,
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

    public function show(Request $request, $id)
    {
        $token = $request->header("Authorization");
        $jwtAuth = new JwtAuth();
        $user = $jwtAuth->checkToken($token, true);

        $client = Client::find($id);

        return response()->json([
            "status" => "success",
            "code" => 200,
            "client" => $client,
            "created_by" => $user
        ]);
    }
}
