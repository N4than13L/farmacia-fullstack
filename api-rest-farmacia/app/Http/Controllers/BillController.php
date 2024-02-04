<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\JwtAuth;
use App\Models\Bill;

class BillController extends Controller
{

    public function index(Request $request)
    {
        $bill = Bill::all();

        $data = array(
            "status" => "success",
            "code" => 200,
            "bill" => $bill
        );

        return response()->json($data, $data['code']);
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
        $personal = $request->input("personal");
        $medicine_id = $request->input("medicine_id");
        $amount = $request->input("amount");
        $clients_id = $request->input("clients_id");

        if ($checkToken && !empty($personal) && !empty($medicine_id) && !empty($amount) && !empty($clients_id)) {

            // verificar datos por cabezera.
            $jwtAuth = new JwtAuth();
            $user = $jwtAuth->checkToken($token, true);

            // guardar cliente
            $bill = new Bill();
            $bill->personal = $personal;
            $bill->amount = $amount;
            $bill->medicine_id = $medicine_id;
            $bill->clients_id = $clients_id;
            $bill->user_id = $user->sub;
            $bill->save();

            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "factura guardada con exito",
                "user" => $user->name . " " . $user->surname,
                "bill" => $bill,
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
        // recoger datos por post 
        // recoger token por la cabezera
        $token = $request->header("Authorization");
        $jwtAuth = new JwtAuth();

        // sacar datos del usuario identificado via token
        $checkToken = $jwtAuth->checkToken($token);

        // Recibir los datos por POST.
        $personal = $request->input("personal");
        $medicine_id = $request->input("medicine_id");
        $amount = $request->input("amount");
        $clients_id = $request->input("clients_id");

        if ($checkToken && !empty($personal) && !empty($medicine_id) && !empty($amount) && !empty($clients_id)) {
            // recoger datos por post.
            $jwtAuth = new JwtAuth();

            $user = $jwtAuth->checkToken($token, true);

            // guardar factura
            $bill = new Bill();
            $bill->personal = $personal;
            $bill->amount = $amount;
            $bill->medicine_id = $medicine_id;
            $bill->clients_id = $clients_id;
            $bill->user_id = $user->sub;
            $old = Bill::find($id);

            $bill->update();

            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "factura actualizada con exito",
                "user" => $user->name . " " . $user->surname,
                "bill" => $bill,
                "old" => $old
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


    public function detail(Request $request, $id)
    {
        $token = $request->header("Authorization");
        $jwtAuth = new JwtAuth();
        $user = $jwtAuth->checkToken($token, true);

        $bill = Bill::find($id);

        if ($user) {
            $data = array(
                "status" => "success",
                "code" => 200,
                "user" => $user->name . " " . $user->surname,
                "bill" => $bill,
            );
        }

        return response()->json($data, $data['code']);
    }

    public function delete(Request $request, $id)
    {
        $token = $request->header("Authorization");
        $jwtAuth = new JwtAuth();
        $user = $jwtAuth->checkToken($token, true);

        $bill = Bill::find($id);

        if ($user->sub == $bill->user_id) {

            $bill->delete();

            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "registro de la tabla ha sido eliminado",
                "bill" => $bill,
            );
        }

        return response()->json($data, $data['code']);
    }
}
