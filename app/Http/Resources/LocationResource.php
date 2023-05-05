<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'is_enabled' => $this->is_enabled,
            'name' => $this->name,
            'coordinates' => $this->latitude . ', ' . $this->longitude,
            'zip' => $this->zip,
            'prefecture' => new PrefectureResource($this->prefecture),
            'address' => $this->address,
            'address2' => $this->address2,
            'phone' => $this->phone,
            'email' => $this->email,
            'socials'=> new SocialResource($this->socials),
            'business_hours_start' => $this->business_hours_start,
            'business_hours_end' => $this->business_hours_end,
            'workday_mon' => $this->workday_mon,
            'workday_tue' => $this->workday_tue,
            'workday_wed' => $this->workday_wed,
            'workday_thu' => $this->workday_thu,
            'workday_fri' => $this->workday_fri,
            'workday_sat' => $this->workday_sat,
            'workday_sun' => $this->workday_sun,
            'description' => $this->description,
            'photos' => new PhotosListCollection($this->photos),
        ];
    }
}
