<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EffectController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TypeMedicineController;
use App\Http\Controllers\MedicineController;

use App\Http\Middleware\ApiAuthMiddleware;

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
Route::post('/api/user/update', [UserController::class, 'update'])->middleware(ApiAuthMiddleware::class);;
// ver perfil
Route::get('/api/user/profile/{id}', [UserController::class, 'profile'])->middleware(ApiAuthMiddleware::class);

// Clientes
Route::get('/api/clients', [ClientController::class, 'index'])->middleware(ApiAuthMiddleware::class);

Route::get('/api/clients/{id}', [ClientController::class, 'show'])->middleware(ApiAuthMiddleware::class);

Route::post('/api/clients/agregar', [ClientController::class, 'save'])->middleware(ApiAuthMiddleware::class);

Route::post('/api/clients/update/{id}', [ClientController::class, 'update'])->middleware(ApiAuthMiddleware::class);

// rutas para efectos de las medicinas.
// ver
Route::get('/api/seceffects/index', [EffectController::class, 'index'])->middleware(ApiAuthMiddleware::class);

// guardar
Route::post('/api/seceffects/save', [EffectController::class, 'save'])->middleware(ApiAuthMiddleware::class);

// sacar uno
Route::get('/api/seceffects/detail/{id}', [EffectController::class, 'detail'])->middleware(ApiAuthMiddleware::class);

// eliminar
Route::get('/api/seceffects/delete/{id}', [EffectController::class, 'delete'])->middleware(ApiAuthMiddleware::class);

// tipo de medicina. 
Route::get('/api/typemedicine/index', [TypeMedicineController::class, 'index'])->middleware(ApiAuthMiddleware::class);
// guardar medicina
Route::post('/api/typemedicine/save', [TypeMedicineController::class, 'save'])->middleware(ApiAuthMiddleware::class);
// actualiizar medicina.
Route::post('/api/typemedicine/update/{id}', [TypeMedicineController::class, 'update'])->middleware(ApiAuthMiddleware::class);

// mostrar 1.
Route::get('/api/typemedicine/detail/{id}', [TypeMedicineController::class, 'detail'])->middleware(ApiAuthMiddleware::class);

// eliminar.
Route::delete('/api/typemedicine/delete/{id}', [TypeMedicineController::class, 'delete'])->middleware(ApiAuthMiddleware::class);

// acciones para el suplidor.
// mostrar todo. 
Route::get('/api/supplier/index', [SupplierController::class, 'index'])->middleware(ApiAuthMiddleware::class);
// acccion de guardar.
Route::post('/api/suplier/save', [SupplierController::class, 'save'])->middleware(ApiAuthMiddleware::class);
// actualizar
Route::post('/api/suplier/update/{id}', [SupplierController::class, 'update'])->middleware(ApiAuthMiddleware::class);
// mostrar 1
Route::get('/api/suplier/detail/{id}', [SupplierController::class, 'detail'])->middleware(ApiAuthMiddleware::class);
// eliminar
Route::get('/api/suplier/delete/{id}', [SupplierController::class, 'delete'])->middleware(ApiAuthMiddleware::class);

// rutas para la medicina
// ver todas
Route::get('/api/mediccine/index', [MedicineController::class, 'index'])->middleware(ApiAuthMiddleware::class);

// guardar medicinas
Route::post('/api/mediccine/save', [MedicineController::class, 'save'])->middleware(ApiAuthMiddleware::class);

// guardar medicinas
Route::post('/api/mediccine/update/{id}', [MedicineController::class, 'update'])->middleware(ApiAuthMiddleware::class);

// ver detalle
Route::get('/api/mediccine/detail/{id}', [MedicineController::class, 'detail'])->middleware(ApiAuthMiddleware::class);

// eliminar medicamento
Route::get('/api/mediccine/delete/{id}', [MedicineController::class, 'delete'])->middleware(ApiAuthMiddleware::class);
