<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class MerchantRegister extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'merchant:register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Merchant register command';

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
        $shop_name = $this->ask('Shop Name');
        $email = $this->ask('Email');
        $password = $this->secret('Password');
        $password_confirmation = $this->secret('Password again');
        $responce = Http::withHeaders([
            'Accept' => 'application/json'
        ])->post('http://127.0.0.1:8000/api/signup', [
            'shop_name' => $shop_name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password_confirmation
        ]);
        // dd($responce);

        if ($responce->ok()) {
            $this->info('Registration - success!');
        } else {
            $this->error('Registration failed.');
            $this->line(print_r($responce->json(), true));
        }
        return 0;
    }
}
