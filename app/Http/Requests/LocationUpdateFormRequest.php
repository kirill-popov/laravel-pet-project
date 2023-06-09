<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationUpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|max:255',
            'is_enabled'    => 'boolean',
            'latitude'      => 'nullable|numeric|between:-90,90',
            'longitude'     => 'nullable|numeric|between:-180,180',
            'zip'           => 'required|max:255',
            'prefecture_id' => 'required|integer',
            'address'       => 'required|max:255',
            'address2'      => 'nullable|max:255',
            'phone'         => 'nullable|max:255',
            'email'         => 'nullable|email|max:256',
            'business_hours_start'  => 'nullable|date_format:H:i',
            'business_hours_end'    => 'nullable|date_format:H:i',
            'workday_mon'   => 'boolean',
            'workday_tue'   => 'boolean',
            'workday_wed'   => 'boolean',
            'workday_thu'   => 'boolean',
            'workday_fri'   => 'boolean',
            'workday_sat'   => 'boolean',
            'workday_sun'   => 'boolean',
            'description'   => 'nullable|max:255',
            'socials'       => 'nullable',
            'socials.facebook'  => 'nullable|max:255',
            'socials.instagram' => 'nullable|max:255',
            'socials.twitter'   => 'nullable|max:255',
            'socials.line'      => 'nullable|max:255',
            'socials.tiktok'    => 'nullable|max:255',
            'socials.youtube'   => 'nullable|max:255',
            'photos'            => 'nullable',
            'photos.is_default' => 'boolean',
            'photos.url'        => 'string|max:255',
        ];
    }
}
