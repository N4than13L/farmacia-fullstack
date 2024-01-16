<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EffectController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TypeMedicineController;
use App\Http\Controllers\MedicineController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return "<h1>Probando ORM</h1>";
});

// rutas del A.P.I
// registro
Route::post('/api/register', [UserController::class, 'register']);
// login
Route::post('/api/login', [UserController::class, 'login']);
// actualizar
Route::post('/api/user/update', [UserController::class, 'update']);
// ver perfil
Route::get('/api/user/profile/{id}', [UserController::class, 'profile']);
