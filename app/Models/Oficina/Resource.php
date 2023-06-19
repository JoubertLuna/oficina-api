<?php

namespace App\Models\Oficina;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'res', 'url'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
