<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InviteNotSentException extends Exception
{
    public function render(Request $request): Response
    {
        return response(
            ['message' => 'Invite mail not sent.'],
            500
        );
    }
}
