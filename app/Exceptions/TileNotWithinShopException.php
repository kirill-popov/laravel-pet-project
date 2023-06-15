<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TileNotWithinShopException extends Exception
{
    public function render(Request $request): Response
    {
        return response(
            ['message' => 'The given tile must be within the Shop.'],
            403
        );
    }
}
