<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MapExistsException extends Exception
{
    public function render(Request $request): Response
    {
        return response(
            ['message' => 'Map already exists.'],
            403
        );
    }
}
