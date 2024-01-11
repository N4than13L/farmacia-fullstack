<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function test(Request $request)
    {
        return "controlador de medicamentos";
    }
}
