<?php

namespace App\Http\Controllers\Oficina;

use App\Http\Controllers\Controller;
use App\Http\Requests\Oficina\RoleRequest;

use App\Http\Resources\Oficina\Role\{
    RoleCollection,
    RoleResource,
};

use App\Models\Oficina\Role;

class RoleController extends Controller
{
    private $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->role->latest()->paginate(15);
        return new RoleCollection($roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        try {
            $this->role->create($request->all());
            return response()->json([
                'data' => [
                    'msg' => 'Perfil cadastrado com sucesso'
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => [
                'msg' => 'Falha ao cadastrar o perfil'
            ]], 401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $url)
    {
        if (!$role = $this->role->where('url', $url)->first()) {
            return response()->json(['error' => [
                'msg' => 'Item não encontrado'
            ]], 404);
        }

        return new RoleResource($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $url)
    {
        if (!$role = $this->role->where('url', $url)->first()) {
            return response()->json(['error' => [
                'msg' => 'Item não encontrado'
            ]], 404);
        }

        try {
            $role->update($request->all());
            return response()->json([
                'data' => [
                    'msg' => 'Perfil editado com sucesso'
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => [
                'msg' => 'Falha ao editar o perfil'
            ]], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $url)
    {
        if (!$role = $this->role->where('url', $url)->first()) {
            return response()->json(['error' => [
                'msg' => 'Item não encontrado'
            ]], 404);
        }

        if ($role->id <= '4') {
            return response()->json(['error' => [
                'msg' => 'Você não pode deletar perfil padrão do sistema'
            ]], 422);
        }

        try {
            $role->delete();
            return response()->json([
                'data' => [
                    'msg' => 'Perfil excluído com sucesso'
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => [
                'msg' => 'Falha ao excluir o perfil'
            ]], 401);
        }
    }
}
