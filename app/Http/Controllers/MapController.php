<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index(Request $request)
    {
        if ($request->is('api/*')) {
            $maps = Map::select('*')
            ->with('location')
            ->paginate(10);
            return $maps;
        }
    }

    public function show(Request $request, Map $map)
    {
        if ($request->is('api/*')) {
            return $map->load([
                'location'
            ]);
        }
    }
}
