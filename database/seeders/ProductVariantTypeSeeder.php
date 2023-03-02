<?php

namespace Database\Seeders;

use App\Models\ProductVariantType;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class ProductVariantTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductVariantType::firstOrCreate([
            'name' => 'Ukuran',
        ]);
        ProductVariantType::firstOrCreate([
            'name' => 'Warna',
        ]);
    }
}
