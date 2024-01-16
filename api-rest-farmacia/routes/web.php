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

// Route::get('/', function () {
//     return "<h1>Probando ORM</h1>";
// });

// Route::get('/', [BillController::class, 'index']);

// rutas del A.P.I para pruebas
Route::get('/user/test', [UserController::class, 'test']);

Route::get('/bill/test', [BillController::class, 'test']);

Route::get('/client/test', [ClientController::class, 'test']);

Route::get('/effect/test', [EffectController::class, 'test']);

Route::get('/employee/test', [EmployeeController::class, 'test']);

Route::get('/medicine/test', [MedicineController::class, 'test']);

Route::get('/suplier/test', [SupplierController::class, 'test']);

Route::get('/typemedicine/test', [TypeMedicineController::class, 'test']);

// rutas del A.P.I
Route::post('/api/register', [UserController::class, 'register']);

Route::post('/api/login', [UserController::class, 'login']);

Route::post('/api/user/update', [UserController::class, 'update']);
Route::get('/api/user/profile/{id}', [UserController::class, 'profile']);
