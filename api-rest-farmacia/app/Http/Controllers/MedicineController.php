<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\JwtAuth;
use Illuminate\Support\Facades\Validator;
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
                'type_medicine_id' => "required",
                "sec_effects_id" => "required",
                "supplier_id" => "required"

            ]);

            // guardar cliente
            $medicine = new Medicine();
            $medicine->name = $params_array['name'];
            $medicine->user_id = $user->sub;
            $medicine->type_medicine_id = $params_array['type_medicine_id'];
            $medicine->sec_effects_id = $params_array['sec_effects_id'];
            $medicine->supplier_id = $params_array['supplier_id'];

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
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        if ($checkToken && !empty($params_array)) {
            // recoger datos por post.
            $jwtAuth = new JwtAuth();

            $user = $jwtAuth->checkToken($token, true);

            // validar datos.
            $validate = Validator::make($params_array, [
                'name' => 'required|alpha',
                'user_id' => 'required' . $user->sub
            ]);

            // guardar cliente
            $medicine = Medicine::find($id);
            $medicine->name = $params_array['name'];
            $medicine->user_id = $user->sub;
            $medicine->type_medicine_id = $params_array['type_medicine_id'];
            $medicine->sec_effects_id = $params_array['sec_effects_id'];
            $medicine->supplier_id = $params_array['supplier_id'];

            $medicine->update();

            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "medicamento actualizado con exito",
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
