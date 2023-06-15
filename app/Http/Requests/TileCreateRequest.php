<?php

namespace App\Http\Requests;

use App\Models\Tile;
use Illuminate\Foundation\Http\FormRequest;

class TileCreateRequest extends FormRequest
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
            'type'      => 'required|in:'.Tile::SIZE_SM.','.Tile::SIZE_MD.','.Tile::SIZE_LG.','.Tile::SIZE_XL,
            'link_to'   => 'required|max:255',
            'title'     => 'nullable|max:255',
            'subtitle'  => 'nullable|max:255',
            'img_url'   => 'nullable|max:255',
        ];
    }
}
