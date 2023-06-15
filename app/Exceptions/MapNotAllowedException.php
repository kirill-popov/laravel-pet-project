<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MapNotAllowedException extends Exception
{
    public function render(Request $request): Response
    {
        return response(
            ['message' => 'The given map should be from your Shop.'],
            403
        );
    }
}
