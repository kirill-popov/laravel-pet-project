<?php

namespace App\Repositories\Interfaces;

use App\Models\Transaction;

interface TransactionRepositoryInterface
{
    public function updateOrCreate(array $data): Transaction;

    public function updateInvoiceTotalSum(): void;
}
