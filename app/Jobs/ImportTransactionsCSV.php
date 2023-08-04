<?php

namespace App\Jobs;

use App\Services\Transaction\TransactionServiceInterface;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use SplFileObject;

class ImportTransactionsCSV implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $filepath;
    protected $start;
    protected $end;

    /**
     * Create a new job instance.
     */
    public function __construct(
        $filepath,
        $start=0,
        $end=1
    ) {
        $this->filepath = $filepath;
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * Execute the job.
     */
    public function handle(TransactionServiceInterface $transactionService): void
    {
        $file = new SplFileObject($this->filepath);

        while (!$file->eof() && $this->start < $this->end) {
            if (1 == $this->start) {
                ++$this->start;
                continue;
            }

            $file->seek($this->start);
            $row = $file->fgetcsv();

            if (empty($row[0])) {continue;}

            $transactionService->updateOrCreateTransaction([
                'invoice_number'    => $row[0],
                'stock_code'        => $row[1],
                'description'       => $row[2],
                'quantity'          => $row[3],
                'invoice_date'      => $row[4],
                'unit_price'        => $row[5],
                'customer_id'       => $row[6],
                'country'           => $row[7],
            ]);
            $file->next();
            ++$this->start;
        }
    }
}
