<?php

namespace App\Services\Transaction;

use App\Models\Transaction;

interface TransactionServiceInterface
{
    public function updateOrCreateTransaction(array $data): Transaction;

    public function updateInvoiceTotalSum(): void;
}
