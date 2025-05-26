<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProdutoController;
use App\Http\Controllers\Api\PedidoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Registro e login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    // Demais rotas futuras (pedidos, envio de fotos, etc.)
    Route::get('/pedidos/{id}/status-log', [PedidoController::class, 'statusLog']);
});

// Produtos disponíveis
Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/produtos/{id}', [ProdutoController::class, 'show']);

//PEDIDOS
Route::get('/pedidos', [PedidoController::class, 'index']);
Route::get('/pedidos/{id}', [PedidoController::class, 'show']);

Route::post('/pedidos', [PedidoController::class, 'store']);
Route::post('/pedido-produto/{id}/fotos', [PedidoController::class, 'uploadFotos']);
Route::post('/pedidos/{id}/cancelar', [PedidoController::class, 'cancelar']);

//MOLDURAS
Route::get('/mold-options', [\App\Http\Controllers\Api\MolduraController::class, 'index']);
