<?php

namespace App\Http\Controllers;

use App\Models\Tile;
use Illuminate\Http\Request;

class TileController extends Controller
{
    public function index(Request $request, $shop_id='')
    {
        $input = $request->input();
        // dd($input);
        if ($request->is('api/*')) {
            $tilesQ = Tile::with('shop');
            if (!empty($input['shop_id']) && is_numeric($input['shop_id'])) {
                $tilesQ->where('shop_id', '=', $input['shop_id']);
            }
            $tiles = $tilesQ->paginate(10);
            return $tiles;
        }
    }

    public function show(Request $request, Tile $tile)
    {
        if ($request->is('api/*')) {
            return $tile->load([
                'shop'
            ]);
        }
    }
}
