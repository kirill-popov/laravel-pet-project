<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\JsonResponse;

class InviteCreateFailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'message' => 'Invitation not sent.'
        ];
    }

    public function withResponse(Request $request, JsonResponse $response): void
    {
        $response->setStatusCode(500);
    }
}
