<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'facebook'  => $this->facebook,
            'instagram' => $this->instagram,
            'twitter'   => $this->twitter,
            'line'      => $this->line,
            'tiktok'    => $this->tiktok,
            'youtube'   => $this->youtube
        ];
    }
}
