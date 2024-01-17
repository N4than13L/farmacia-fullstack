<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\JwtAuth;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header("Authorization");
        $jwtAuth = new JwtAuth();

        // sacar datos del usuario identificado via token
        $checkToken = $jwtAuth->checkToken($token);

        if ($checkToken) {
            return $next($request);
        } else {
            $data = array(
                "status" => "error",
                "code" => 500,
                "message" => "No estas identificado"
            );
        }
        return response()->json($data, $data['code']);
    }
}
