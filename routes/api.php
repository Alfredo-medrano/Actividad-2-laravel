<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ApiController;

Route::get('/usuarios/{id}/pedidos', [ApiController::class, 'pedidosPorUsuario']);
Route::get('/pedidos/detalles', [ApiController::class, 'pedidosConUsuarios']);
Route::get('/usuarios/buscar', [ApiController::class, 'buscarUsuariosPorLetra']);
Route::get('/pedidos/usuario/5/total', [ApiController::class, 'totalRegistrosPedidos']);
Route::get('/pedidos/ordenados', [ApiController::class, 'pedidosConUsuariosOrdenados']);
Route::get('/pedidos/suma', [ApiController::class, 'sumaTotalPedidos']);
Route::get('/pedidos/economico', [ApiController::class, 'pedidoMasEconomico']);
Route::get('/pedidos/agrupados', [ApiController::class, 'pedidosPorUsuarioAgrupados']);


