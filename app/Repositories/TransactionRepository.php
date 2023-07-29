<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function updateOrCreate(array $data): Transaction
    {
        $transaction = Transaction::create([
            'invoice_number'    => $data['invoice_number'],
            'stock_code'        => $data['stock_code'],
            'description'       => $data['description'],
            'quantity'          => $data['quantity'],
            'invoice_date'      => date('Y-m-d H:i:s', strtotime($data['invoice_date'])),
            'unit_price'        => $data['unit_price'],
            'customer_id'       => !empty($data['customer_id']) ? $data['customer_id'] : null,
            'country'           => $data['country'],
            'total_price'       => $data['quantity'] * $data['unit_price'],
        ]);

        return $transaction;
    }

    public function updateInvoiceTotalSum(): void
    {
        $results = DB::table('transactions')
        ->select('invoice_number', DB::raw('SUM(total_price) as total_sum'))
        ->groupBy('invoice_number')
        ->orderBy('invoice_number')
        ->chunkById(100, function (Collection $invoices) {
            $invoices->each(function ($invoice, $key) {
                DB::table('transactions')
                ->where('invoice_number', $invoice->invoice_number)
                ->update(['total_sum' => $invoice->total_sum]);
            });
        }, 'invoice_number')
        ;
        // logger(print_r($results, true));
    }
}
