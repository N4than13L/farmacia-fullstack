<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sec_effect;
use App\Helpers\JwtAuth;
use Illuminate\Support\Facades\Validator;

class EffectController extends Controller
{
    public function index(Request $request)
    {
        $sec_effects = Sec_effect::all();

        $data = array(
            "status" => "success",
            "code" => 200,
            "secondary_effects" => $sec_effects
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
                'user_id' => 'required' . $user->sub
            ]);

            // guardar cliente
            $sec_effects = new Sec_effect();
            $sec_effects->name = $params_array['name'];
            $sec_effects->user_id = $user->sub;

            $sec_effects->save();

            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "effectos guardado con exito",
                "user" => $user->name . " " . $user->surname,
                "secondary_effects" => $sec_effects,
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
            $sec_effects = Sec_effect::find($id);
            $sec_effects->name = $params_array['name'];
            $sec_effects->user_id = $user->sub;

            $sec_effects->update();

            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "effectos guardado con exito",
                "user" => $user->name . " " . $user->surname,
                "secondary_effects" => $sec_effects,
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

        $sec_effects = Sec_effect::find($id);

        if ($user) {
            $data = array(
                "status" => "success",
                "code" => 200,
                "user" => $user->name . " " . $user->surname,
                "secondary_effects" => $sec_effects,
            );
        }

        return response()->json($data, $data['code']);
    }

    public function delete(Request $request, $id)
    {

        $token = $request->header("Authorization");
        $jwtAuth = new JwtAuth();
        $user = $jwtAuth->checkToken($token, true);

        $sec_effects = Sec_effect::find($id);

        if ($user->sub == $sec_effects->user_id) {

            $sec_effects->delete();

            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "registro de la tabla ha sido eliminado",
                "secondary_effects" => $sec_effects,
            );
        }

        return response()->json($data, $data['code']);
    }
}
