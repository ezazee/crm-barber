<?php

namespace Database\Seeders;

use App\Models\MerchantLevel;
use Illuminate\Database\Seeder;

class MerchantLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MerchantLevel::firstOrCreate([
            'level' => 1,
            'name' => 'Basic Merchant',
        ]);
        MerchantLevel::firstOrCreate([
            'level' => 2,
            'name' => 'Power Merchant',
        ]);
    }
}
