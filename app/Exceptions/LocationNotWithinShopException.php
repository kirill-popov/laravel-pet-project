<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LocationNotWithinShopException extends Exception
{
    public function render(Request $request): Response
    {
        return response(
            ['message' => 'The given location must be within the Shop locations.'],
            403
        );
    }
}
