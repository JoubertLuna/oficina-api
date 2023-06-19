<?php

use App\Http\Controllers\Oficina\ResRoleController;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth', 'verified', 'access.control.list')->group(function () {

    #Resource x Role
    Route::get('role/{id}/resources/{idResource}/detach', [ResRoleController::class, 'detachResourceRole'])->name('role.resources.detach');

    Route::post('role/{id}/resources/store', [ResRoleController::class, 'attachResourcesRole'])->name('role.resources.attach');

    Route::get('role/{id}/resources/create', [ResRoleController::class, 'resourcesAvailable'])->name('role.resources.available');

    Route::get('role/{id}/resources', [ResRoleController::class, 'resources'])->name('role.resources');
    #Resource x Role

    #Role x Resource
    Route::get('resources/{id}/role', [ResRoleController::class, 'roles'])->name('resources.role');
    #Role x Resource

//});
