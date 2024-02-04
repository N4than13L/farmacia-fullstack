<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\JwtAuth;
use App\Models\Medicine;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        $medicine = Medicine::all();

        $data = array(
            "status" => "success",
            "code" => 200,
            "medicine" => $medicine
        );

        return response()->json($data, $data['code']);
    }

    public function save(Request $request)
    {
        // recoger token por la cabezera
        $token = $request->header("Authorization");
        $jwtAuth = new JwtAuth();

        // sacar datos del usuario identificado via token
        $checkToken = $jwtAuth->checkToken($token);

        // Recibir los datos por POST.
        $name = $request->input("name");
        $type_medicine_id = $request->input("type_medicine_id");
        $sec_effects_id = $request->input("sec_effects_id");
        $supplier_id = $request->input("supplier_id");

        if ($checkToken && !empty($name) && !empty($type_medicine_id) &&  !empty($sec_effects_id) && !empty($supplier_id)) {
            // recoger datos por post.
            $jwtAuth = new JwtAuth();

            $user = $jwtAuth->checkToken($token, true);
            // guardar cliente
            $medicine = new Medicine();
            $medicine->name =  $name;
            $medicine->user_id = $user->sub;
            $medicine->type_medicine_id = $type_medicine_id;
            $medicine->sec_effects_id = $sec_effects_id;
            $medicine->supplier_id = $supplier_id;

            $medicine->save();

            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "medicamento guardado con exito",
                "user" => $user->name . " " . $user->surname,
                "medicine" => $medicine,
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
        $type_medicine_id = $request->input("type_medicine_id");
        $sec_effects_id = $request->input("sec_effects_id");
        $supplier_id = $request->input("supplier_id");


        if ($checkToken && !empty($name) && !empty($type_medicine_id) &&  !empty($sec_effects_id) && !empty($supplier_id)) {
            // recoger datos por post.
            $jwtAuth = new JwtAuth();

            $user = $jwtAuth->checkToken($token, true);

            // guardar cliente
            $medicine = Medicine::find($id);
            $medicine->name =  $name;
            $medicine->user_id = $user->sub;
            $medicine->type_medicine_id = $type_medicine_id;
            $medicine->sec_effects_id = $sec_effects_id;
            $medicine->supplier_id = $supplier_id;

            $old = Medicine::find($id);

            $medicine->update();

            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "medicamento actualizado con exito",
                "user" => $user->name . " " . $user->surname,
                "medicine" => $medicine,
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

        $medicine = Medicine::find($id);

        if ($user) {
            $data = array(
                "status" => "success",
                "code" => 200,
                "user" => $user->name . " " . $user->surname,
                "medicine" => $medicine,
            );
        }

        return response()->json($data, $data['code']);
    }

    public function delete(Request $request, $id)
    {
        $token = $request->header("Authorization");
        $jwtAuth = new JwtAuth();
        $user = $jwtAuth->checkToken($token, true);

        $medicine = Medicine::find($id);

        if ($user->sub == $medicine->user_id) {

            $medicine->delete();

            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "registro de la tabla ha sido eliminado",
                "medicine" => $medicine,
            );
        }

        return response()->json($data, $data['code']);
    }
}
