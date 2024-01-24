<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\JwtAuth;
use Illuminate\Support\Facades\Validator;
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
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        if ($checkToken && !empty($params_array)) {
            // recoger datos por post.
            $jwtAuth = new JwtAuth();

            $user = $jwtAuth->checkToken($token, true);

            // validar datos.
            $validate = Validator::make($params_array, [
                'name' => 'required|alpha',
                'user_id' => 'required' . $user->sub,
                'medicine_id' => "required",
                'amount' => 'required',
                "client_id" => "required"

            ]);

            // guardar cliente
            $bill = new Bill();
            $bill->name = $params_array['name'];
            $bill->user_id = $user->sub;
            $bill->medicine_id = $params_array['medicine_id'];
            $bill->amount = $params_array['amount'];
            $bill->client_id = $params_array['client_id'];
            $bill->save();

            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "medicamento guardado con exito",
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
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        if ($checkToken && !empty($params_array)) {
            // recoger datos por post.
            $jwtAuth = new JwtAuth();

            $user = $jwtAuth->checkToken($token, true);


            // validar datos.
            $validate = Validator::make($params_array, [
                'name' => 'required|alpha',
                'user_id' => 'required' . $user->sub,
                'medicine_id' => "required",
                'amount' => 'required',
                "client_id" => "required"

            ]);

            // guardar factura
            $bill = new Bill();
            $bill->name = $params_array['name'];
            $bill->user_id = $user->sub;
            $bill->medicine_id = $params_array['medicine_id'];
            $bill->amount = $params_array['amount'];
            $bill->client_id = $params_array['client_id'];
            $bill->update();

            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "medicamento actualizado con exito",
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
