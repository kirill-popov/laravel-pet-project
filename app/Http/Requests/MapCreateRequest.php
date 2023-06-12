<?php

namespace App\Http\Requests;

use App\Models\Map;
use App\Repositories\Interfaces\LocationRepositoryInterface;
use App\Rules\MapLocationWithinShop;
use Illuminate\Auth\AuthManager;
use Illuminate\Foundation\Http\FormRequest;

class MapCreateRequest extends FormRequest
{
    public function __construct(
        protected readonly AuthManager $authManager,
        protected readonly LocationRepositoryInterface $locationRepository,
    ) {
    }

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
            'location_id'   => ['bail', 'required', 'numeric', 'exists:locations,id',
             new MapLocationWithinShop($this->authManager, $this->locationRepository)
            ],
            'is_enabled'    => 'required|boolean',
            'style'         => 'required|in:'.Map::SIZE_MD.','.Map::SIZE_LG,
        ];
    }
}
