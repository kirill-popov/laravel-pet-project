<?php

namespace App\Http\Requests;

use App\Models\Map;
use Illuminate\Foundation\Http\FormRequest;

class MapCreateRequest extends FormRequest
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
            'location_id'   => ['required', 'numeric', 'exists:locations,id'],
            'is_enabled'    => 'required|boolean',
            'style'         => 'required|in:'.Map::SIZE_MD.','.Map::SIZE_LG,
        ];
    }
}
