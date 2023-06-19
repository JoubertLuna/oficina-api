<?php

namespace App\Observers\Oficina;

use App\Models\Oficina\Resource;
use Illuminate\Support\Str;

class ResourceObserver
{
    /**
     * Handle the Resource "creating" event.
     */
    public function creating(Resource $resource): void
    {
        $resource->url = Str::kebab($resource->nome);
    }

    /**
     * Handle the Resource "updating" event.
     */
    public function updating(Resource $resource): void
    {
        $resource->url = Str::kebab($resource->nome);
    }
}
