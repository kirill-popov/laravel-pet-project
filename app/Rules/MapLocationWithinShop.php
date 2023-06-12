<?php

namespace App\Rules;

use App\Repositories\Interfaces\LocationRepositoryInterface;
use Closure;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Validation\ValidationRule;

class MapLocationWithinShop implements ValidationRule
{
    public function __construct(
        protected readonly AuthManager $authManager,
        protected readonly LocationRepositoryInterface $locationRepository,
    ) {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $userShop = $this->authManager->guard()->user()->shop;

        $location = $this->locationRepository->getLocationById($value);
        $locationShop = $location->shop;

        if ($userShop->id !== $locationShop->id) {
            $fail('The :attribute must be within the Shop locations.');
        }
    }
}
