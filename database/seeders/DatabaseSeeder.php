<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(MerchantLevelSeeder::class);
        $this->call(LogisticSeeder::class);
        $this->call(ProductVariantTypeSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(CouponSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(ProductCategorySeeder::class);
        // $this->call(RegionSeeder::class);
        // $this->call(UserSeeder::class);
    }
}
