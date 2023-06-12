<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MapResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'is_enabled' => $this->is_enabled,
            'style' => $this->style,
            'shop' => new ShopResource(
                $this->shop
            ),
            'default_location' => new LocationResource(
                $this->location
            )
        ];
    }
}
