<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TileResource extends JsonResource
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
            'type' => $this->type,
            'img_only' => $this->img_only,
            'link_to' => $this->link_to,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'img_url' => $this->img_url
        ];
    }
}
