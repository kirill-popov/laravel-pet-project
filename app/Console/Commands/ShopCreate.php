<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ShopCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shop create command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('Shop Name');
        $responce = Http::post('http://127.0.0.1:8000/api/shops', [
            'name' => $name
        ])->json();

        if ($responce) {
            $this->info('Shop Created');
        } else {
            $this->error('Shop Not Created');
        }
        return 0;
    }
}
