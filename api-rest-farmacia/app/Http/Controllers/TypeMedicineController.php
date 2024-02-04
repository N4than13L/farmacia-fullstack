<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type_medicine;
use App\Helpers\JwtAuth;

class TypeMedicineController extends Controller
{
    public function index(Request $request)
    {
        $type_medicine = Type_medicine::all();

        $data = array(
            "status" => "success",
            "code" => 200,
            "secondary_effects" => $type_medicine
        );

        return response()->json($data, $data['code']);
    }

    public function save(Request $request)
    {
        // recoger datos por post 
        // recoger token por la cabezera
        $token = $request->header("Authorization");
        $jwtAuth = new JwtAuth();

        $name = $request->input("name");

        // sacar datos del usuario identificado via token
        $checkToken = $jwtAuth->checkToken($token);

        // Recibir los datos por POST.
        // $json = $request->input('json', null);
        // $params_array = json_decode($json, true);

        if ($checkToken && !empty($name)) {
            // recoger datos por post.
            $jwtAuth = new JwtAuth();

            $user = $jwtAuth->checkToken($token, true);

            // guardar cliente
            $type_medicine = new Type_medicine();
            $type_medicine->name = $name;
            $type_medicine->user_id = $user->sub;

            $type_medicine->save();

            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "effectos guardado con exito",
                "user" => $user->name . " " . $user->surname,
                "secondary_effects" => $type_medicine,
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

        if ($checkToken && !empty($name)) {
            // recoger datos por post.
            $jwtAuth = new JwtAuth();

            $user = $jwtAuth->checkToken($token, true);

            // guardar cliente
            $type_medicine = Type_medicine::find($id);
            $type_medicine->name = $name;
            $type_medicine->user_id = $user->sub;

            $old = Type_medicine::find($id);


            $type_medicine->update();

            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "effectos guardado con exito",
                "user" => $user->name . " " . $user->surname,
                "changes" => $type_medicine,
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

        $type_medicine = Type_medicine::find($id);

        if ($user) {
            $data = array(
                "status" => "success",
                "code" => 200,
                "user" => $user->name . " " . $user->surname,
                "secondary_effects" => $type_medicine,
            );
        }

        return response()->json($data, $data['code']);
    }

    public function delete(Request $request, $id)
    {

        $token = $request->header("Authorization");
        $jwtAuth = new JwtAuth();
        $user = $jwtAuth->checkToken($token, true);

        $type_medicine = Type_medicine::find($id);

        if ($user->sub == $type_medicine->user_id) {

            $type_medicine->delete();

            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "registro de la tabla ha sido eliminado",
                "type_medicine" => $type_medicine,
            );
        }

        return response()->json($data, $data['code']);
    }
}
