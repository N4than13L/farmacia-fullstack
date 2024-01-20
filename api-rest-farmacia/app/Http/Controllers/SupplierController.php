<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Helpers\JwtAuth;
use Illuminate\Support\Facades\Validator;


class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $suplier = Supplier::all();

        $data = array(
            "status" => "success",
            "code" => 200,
            "suplier" => $suplier
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
                "address" => "required|alpha",
                "phone" => "required|alpha",
                "email" => "required|email",
                "rnc" => "required|alpha",
                'user_id' => 'required' . $user->sub
            ]);

            // guardar cliente
            $supplier = new Supplier();
            $supplier->name = $params_array['name'];
            $supplier->address = $params_array['address'];
            $supplier->phone = $params_array['phone'];
            $supplier->email = $params_array['email'];
            $supplier->rnc = $params_array['rnc'];
            $supplier->user_id = $user->sub;

            $supplier->save();

            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "effectos guardado con exito",
                "user" => $user->name . " " . $user->surname,
                "suplier" => $supplier,
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
                "address" => "required|alpha",
                "phone" => "required|alpha",
                "email" => "required|email",
                "rnc" => "required|alpha",
                'user_id' => 'required' . $user->sub
            ]);

            // guardar cliente
            $supplier = Supplier::find($id);

            // guardar cliente
            $supplier = new Supplier();
            $supplier->name = $params_array['name'];
            $supplier->address = $params_array['address'];
            $supplier->phone = $params_array['phone'];
            $supplier->email = $params_array['email'];
            $supplier->rnc = $params_array['rnc'];
            $supplier->user_id = $user->sub;

            $supplier->update();

            // actualizar datos de usuario
            // $supplier_up = Supplier::where('id', $user->sub)->update($params_array);

            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "effectos guardado con exito",
                "user" => $user->name . " " . $user->surname,
                "suplier" => $supplier,
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

        $supplier = Supplier::find($id);

        if ($user) {
            $data = array(
                "status" => "success",
                "code" => 200,
                "user" => $user->name . " " . $user->surname,
                "secondary_effects" => $supplier,
            );
        }

        return response()->json($data, $data['code']);
    }

    public function delete(Request $request, $id)
    {

        $token = $request->header("Authorization");
        $jwtAuth = new JwtAuth();
        $user = $jwtAuth->checkToken($token, true);

        $supplier = Supplier::find($id);

        if ($user->sub == $supplier->user_id) {

            $supplier->delete();

            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "registro de la tabla ha sido eliminado",
                "suplier" => $supplier,
            );
        }

        return response()->json($data, $data['code']);
    }
}
