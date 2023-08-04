<?php

namespace App\Console\Commands;

use App\Jobs\CalculateInvoicesSum;
use App\Jobs\ImportTransactionsCSV;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use SplFileObject;
use Illuminate\Support\Facades\Bus;
use Throwable;

class ParseAndSaveCSVFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csv:parse {--filename=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parses CSV file, groups the data and saves into database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename_option = $this->option('filename');
        if (!empty($filename_option)) {
            $filename = $filename_option;
        } else {
            $filename = $this->ask('File Name');
        }

        if (Storage::disk('local')->exists($filename)) {
            $batchJobs = [];
            $linesNumber = 0;
            $perJob = 3000;

            $this->info('File found. Processing...');
            $filepath = Storage::path($filename);
            $file = new SplFileObject($filepath);
            $file->seek(PHP_INT_MAX);
            $linesNumber = $file->key();
            $this->info($linesNumber . ' lines');

            for ($start=0, $end=ceil($linesNumber/$perJob); $start < $end; $start++) {
                // $batchJobs[] = [
                //     'start' => $start * $perJob + 1,
                //     'end' => ($start + 1) * $perJob,
                // ];
                $start_line = $start * $perJob + 1;
                $end_line = ($start + 1) * $perJob;
                $batchJobs[] = new ImportTransactionsCSV($filepath, $start_line, $end_line);
            }
            // logger(print_r($batchJobs,true));
            // return;
            $batch = Bus::batch($batchJobs)
            ->then(function (Batch $batch) {
                // All jobs completed successfully...
                CalculateInvoicesSum::dispatch();
            })->catch(function (Batch $batch, Throwable $e) {
                // First batch job failure detected...
            })->finally(function (Batch $batch) {
                // The batch has finished executing...
            })->dispatch();

        } else {
            $this->error('File not found');
        }
    }
}
