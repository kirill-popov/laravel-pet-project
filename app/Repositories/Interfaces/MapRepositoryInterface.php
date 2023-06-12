<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface MapRepositoryInterface
{
    public function getAll(): Collection;
}
