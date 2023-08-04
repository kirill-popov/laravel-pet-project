<?php

namespace App\Services\Transaction;

use App\Models\Transaction;
use App\Repositories\Interfaces\TransactionRepositoryInterface;

class TransactionService implements TransactionServiceInterface
{
    public function __construct(
        protected readonly TransactionRepositoryInterface $transactionRepository,
    ) {
    }

    public function updateOrCreateTransaction(array $data): Transaction
    {
        return $this->transactionRepository->updateOrCreate($data);
    }

    public function updateInvoiceTotalSum(): void
    {
        $this->transactionRepository->updateInvoiceTotalSum();
    }
}
