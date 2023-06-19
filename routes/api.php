<?php

use App\Http\Controllers\Oficina\{
    ResourceController,
    RoleController
};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::middleware('auth', 'verified', 'access.control.list')->group(function () {

// Configurações
#Route Role
Route::resource('role', RoleController::class);
#Route Role

#Route Resource
Route::resource('resource', ResourceController::class);
#Route Resource
// Configurações

//});

require __DIR__ . '/acl.php';
