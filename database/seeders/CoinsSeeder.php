<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoinsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('coins')->insert([
            [
                'title' => 'Bitcoin',
                'symbol' => 'BTC'
            ],
            [
                'title' => 'Ethereum',
                'symbol' => 'ETH'
            ],
            [
                'title' => 'Cardano',
                'symbol' => 'ADA'
            ],
            [
                'title' => 'Solana',
                'symbol' => 'SOL'
            ]
        ]);
    }
}
