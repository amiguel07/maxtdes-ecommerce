<?php

namespace Database\Seeders;
use App\Models\Payment;

use Illuminate\Database\Seeder;

class paymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::truncate();

        Payment::create([
            'image' => 'payments/yape.png',
            'bank' => 'Yape',
            'number' => '555555555'
        ]);

        Payment::create([
            'image' => 'payments/plin.png',
            'bank' => 'Plin',
            'number' => '555555555'
        ]);

        Payment::create([
            'bank' => 'BBVA',
            'number' => '555555555'
        ]);

        Payment::create([
            'bank' => 'ScotiaBank',
            'number' => '555555555'
        ]);

        $this->command->info('Payment table seeded!');
    }
}
