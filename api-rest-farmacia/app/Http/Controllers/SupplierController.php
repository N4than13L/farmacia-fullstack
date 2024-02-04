<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Helpers\JwtAuth;

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
        $name = $request->input("name");
        $address = $request->input("address");
        $phone = $request->input("phone");
        $email = $request->input("email");
        $rnc = $request->input("rnc");

        if ($checkToken && !empty($name) && !empty($address) && !empty($phone) && !empty($email) && !empty($rnc)) {
            // recoger datos por post.
            $jwtAuth = new JwtAuth();

            $user = $jwtAuth->checkToken($token, true);

            // guardar cliente
            $supplier = new Supplier();
            $supplier->name = $name;
            $supplier->address = $address;
            $supplier->phone = $phone;
            $supplier->email = $email;
            $supplier->rnc = $rnc;
            $supplier->user_id = $user->sub;

            $supplier->save();

            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "Suplidor agregado con exito",
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
        $name = $request->input("name");
        $address = $request->input("address");
        $phone = $request->input("phone");
        $email = $request->input("email");
        $rnc = $request->input("rnc");

        if ($checkToken && !empty($name) && !empty($address) && !empty($phone) && !empty($email) && !empty($rnc)) {

            // recoger datos por post.
            $jwtAuth = new JwtAuth();

            $user = $jwtAuth->checkToken($token, true);

            // guardar cliente
            $supplier = Supplier::find($id);

            // guardar cliente
            $supplier = new Supplier();
            $supplier->name = $name;
            $supplier->address = $address;
            $supplier->phone = $phone;
            $supplier->email = $email;
            $supplier->rnc = $rnc;
            $supplier->user_id = $user->sub;

            $old = Supplier::find($id);

            $supplier->update();

            // actualizar datos de usuario
            // $supplier_up = Supplier::where('id', $user->sub)->update($params_array);

            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "suplidor actualizado con exito",
                "user" => $user->name . " " . $user->surname,
                "suplier" => $supplier,
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
