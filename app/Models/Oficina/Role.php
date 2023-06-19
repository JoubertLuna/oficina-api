<?php

namespace App\Models\Oficina;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'role', 'url'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function resources()
    {
        return $this->belongsToMany(Resource::class);
    }

    public function resourcesAvailable()
    {
        $resources = Resource::whereNotIn('id', function ($query) {
            $query->select('resource_role.resource_id');
            $query->from('resource_role');
            $query->whereRaw("resource_role.role_id={$this->id}");
        })->paginate();

        return $resources;
    }
}
