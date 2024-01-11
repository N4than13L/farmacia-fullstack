<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Medicine;

class BillController extends Controller
{
    public function index()
    {
        $bill = Bill::all();
        $medicine = Medicine::all();

        foreach ($bill as $bills) {
            echo "<h1> ID NO: " . $bills->id . "</h1>";
            echo "<p> Cliente: " . $bills->clients->fullname . "</p>";
            echo "<p> Monto: " . $bills->amount . "</p>";
            echo "<p> Medicina: " . $bills->medicine->name . "</p>";
            // echo " " . $bills->type_medicine . "</p>";

            foreach ($medicine as $medicines) {
                echo "<p> tipo de medicamento:" . $medicines->type_medicine->name . "</p>";
            }
        }

        die();
    }
}
