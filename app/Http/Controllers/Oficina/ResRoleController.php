<?php

namespace App\Http\Controllers\Oficina;

use App\Http\Controllers\Controller;

use App\Models\Oficina\{
    Resource,
    Role
};

use Illuminate\Http\Request;

class ResRoleController extends Controller
{
    /**
     * Repository resource x role
     */
    private $role, $resource;

    public function __construct(Role $role, Resource $resource)
    {
        $this->role = $role;
        $this->resource = $resource;
    }

    /**
     * List resource x role
     */
    public function resources($idRole)
    {

        if (!$role = $this->role->find($idRole)) {
            return redirect()->back();
        }

        $resources = $role->resources()->paginate();
        return view('Condominio.Painel.Pages.Role.resources.resources', compact('resources', 'role'));
    }

    public function roles($idResource)
    {

        if (!$resource = $this->resource->find($idResource)) {
            return redirect()->back();
        }

        $roles = $resource->roles()->paginate();
        return view('Condominio.Painel.Pages.Resource.role.role', compact('resource', 'roles'));
    }

    /**
     * Create resource x role
     */

    public function resourcesAvailable($idRole)
    {

        if (!$role = $this->role->find($idRole)) {
            return redirect()->back();
        }

        $resources = $role->resourcesAvailable();
        return view('Condominio.Painel.Pages.Role.resources.available', compact('resources', 'role'));
    }

    /**
     * Store resource x role
     */

    public function attachResourcesRole(Request $request, $idRole)
    {

        if (!$role = $this->role->find($idRole)) {
            return redirect()->back();
        }

        if (!$request->resources || count($request->resources) == 0) {
            return redirect()->back()->with('error', 'Você precisa escolher pelo menos uma permissão');
        }

        $role->resources()->attach($request->resources);

        return redirect()->route('role.resources', $role->id)->with('success', 'permissão adicionada com sucesso');
    }

    /**
     * Store resource x role
     */

    public function detachResourceRole($idRole, $idResource)
    {
        $role = $this->role->find($idRole);
        $resource = $this->resource->find($idResource);

        if (!$role || !$resource) {
            return redirect()->back();
        }

        $role->resources()->detach($resource);

        return redirect()->route('role.resources', $role->id)->with('danger', 'permissão removida com sucesso');
    }
}
