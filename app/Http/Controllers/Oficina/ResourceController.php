<?php

namespace App\Http\Controllers\Oficina;

use App\Http\Controllers\Controller;
use App\Http\Requests\Oficina\ResourceRequest;

use App\Http\Resources\Oficina\Resource\{
    ResCollection,
    ResResource,
};

use App\Models\Oficina\Resource;


class ResourceController extends Controller
{
    private $resource;

    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resources = $this->resource->latest()->paginate(15);
        return new ResCollection($resources);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResourceRequest $request)
    {
        try {
            $this->resource->create($request->all());
            return response()->json([
                'data' => [
                    'msg' => 'Permissão cadastrada com sucesso'
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => [
                'msg' => 'Falha ao cadastrar o permissão'
            ]], 401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $url)
    {
        if (!$resource = $this->resource->where('url', $url)->first()) {
            return response()->json(['error' => [
                'msg' => 'Item não encontrado'
            ]], 404);
        }

        return new ResResource($resource);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ResourceRequest $request, string $url)
    {
        if (!$resource = $this->resource->where('url', $url)->first()) {
            return response()->json(['error' => [
                'msg' => 'Item não encontrado'
            ]], 404);
        }

        try {
            $resource->update($request->all());
            return response()->json([
                'data' => [
                    'msg' => 'Permissão editada com sucesso'
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => [
                'msg' => 'Falha ao editar a permissão'
            ]], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $url)
    {
        if (!$resource = $this->resource->where('url', $url)->first()) {
            return response()->json(['error' => [
                'msg' => 'Item não encontrado'
            ]], 404);
        }

        // if ($resource->id <= '4') {
        //     return response()->json(['error' => [
        //         'msg' => 'Você não pode deletar permissão padrão do sistema'
        //     ]], 422);
        // }

        try {
            $resource->delete();
            return response()->json([
                'data' => [
                    'msg' => 'Permissão excluída com sucesso'
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => [
                'msg' => 'Falha ao excluir a permissão'
            ]], 401);
        }
    }
}
