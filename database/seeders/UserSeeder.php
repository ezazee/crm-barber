<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Local;
use App\Models\LocalAdmin;
use App\Models\LocalHasLogistic;
use App\Models\Logistic;
use App\Models\LogisticService;
use App\Models\LogisticServiceCost;
use App\Models\Merchant;
use App\Models\MerchantAddress;
use App\Models\MerchantLevel;
use App\Models\Province;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            DB::commit();
            // create super admin
            $adminRole = Role::firstOrCreate([
                'name' => 'Super Admin',
                'guard_name' => 'api',
            ]);
            $adminUser = User::firstOrCreate(['email' => 'nuku-01@mailinator.com'], [
                'name' => 'Nuku Super Admin',
                // 'email' => 'superadmin@nuku.id',
                'password' => Hash::make('secret'),
                'status' => 'Active',
                'verified' => true,
            ]);
            $adminDetailUser = Admin::firstOrCreate(['user_id' => $adminUser->id], [
                // 'user_id' => $adminUser->id
                // 'name' => 'Nuku Super Admin',
                'avatar' => 'avatar.jpg',
                'avatar_link' => 'images/avatar.jpg',
            ]);
            $adminUser->assignRole($adminRole);



            // create local data & admin
            $local = Local::firstOrCreate(['name' => 'Jogja Marketplace',], [
                // 'name' => 'Jogja Marketplace',
                'about' => 'Marketplace terbesar di Jogja.'
            ]);
            $localAdminRole = Role::firstOrCreate([
                'name' => 'Local Admin',
                'guard_name' => 'api',
            ]);
            $localAdminUser = User::firstOrCreate(['email' => 'nuku-02@mailinator.com'], [
                'name' => 'Khaleel Severus',
                // 'email' => 'localadmin01@nuku.id',
                'password' => Hash::make('secret'),
                'status' => 'Active',
                'verified' => true,
            ]);
            $localAdminUser->assignRole($localAdminRole);
            $localAdminDetailUser = LocalAdmin::firstOrCreate(['user_id' => $localAdminUser->id, 'local_id' => $local->id], [
                // 'user_id' => $localAdminUser->id,
                // 'local_id' => $local->id,
                // 'name' => $localAdminUser->name,
                // 'email' => $localAdminUser->email,
                'type' => 'PIC Admin',
                'avatar' => 'avatar.jpg',
                'avatar_link' => 'images/avatar.jpg',
            ]);

            // Local > Logistic
            $logisticLocal = Logistic::firstOrCreate([
                'name' => 'Jogi Driver',
                'short_name' => 'Jogi Driver',
                'code' => 'jogi',
                'scope' => 'Local',
                'source' => 'Local System',
                'local_id' => $local->id,
            ], [
                'image_file' => 'images/icon-placeholder-2.jpg',
                'image_file_link' => url('images/icon-placeholder-2.jpg'),
            ]);

            // $logistService = LogisticService::firstOrCreate([
            //     'logistic_id' => $logisticLocal->id,
            //     'name' => 'Jogi Anterin',
            //     'type' => 'Reguler',
            //     'description' => 'Anter Barang Reguler',
            // ]);

            // $provinceData = Province::all();
            // foreach ($provinceData as $key => $provinceDataRow) {
            //     $costAmountArr = [7000, 7500, 8000];
            //     $costAmountSelected = array_rand($costAmountArr);
            //     LogisticServiceCost::firstOrCreate([
            //         'logistic_service_id' => $logistService->id,
            //         'cost_type' => 'By Region',
            //         'cost_for_region_type' => 'Province',
            //         'cost_amount' => $costAmountArr[$costAmountSelected],
            //         'estimation_duration' => '2-3',
            //         'province_id' => $provinceDataRow->id,
            //     ]);
            // }


            $logistService = LogisticService::firstOrCreate([
                'logistic_id' => $logisticLocal->id,
                'name' => 'Jogi Kirimin',
                'type' => 'Instant',
            ], [
                'description' => 'Kirim Barang Instan'
            ]);
            LogisticServiceCost::firstOrCreate([
                'logistic_service_id' => $logistService->id,
                'cost_type' => 'By Distance',
            ], [
                'cost_amount' => 3000,
                'cost_for_distance' => 1,
            ]);


            $logisticLocal = Logistic::firstOrCreate([
                'code' => 'ridehail-' . $local->id,
                'scope' => 'Local',
                'source' => 'Local System',
                'type' => 'Ride-hail',
                'local_id' => $local->id,
            ], [
                'name' => 'Jogi Anterin',
                'short_name' => 'Jogi Anterin',
                'image_file' => 'images/icon-placeholder-2.jpg',
                'image_file_link' => url('images/icon-placeholder-2.jpg'),
            ]);

            // logistic service - ride delivery
            $logistService = LogisticService::firstOrCreate([
                'logistic_id' => $logisticLocal->id,
                'type' => 'Bike Ride-hail',
            ], [
                'name' => $logisticLocal->name . ' Ojek',
                'description' => 'Anter Penumpang dengan Ojek.',
            ]);
            LogisticServiceCost::firstOrCreate([
                'logistic_service_id' => $logistService->id,
                'cost_type' => 'By Distance',
            ], [
                'cost_amount' => 3000,
                'cost_for_distance' => 1,
            ]);
            $logistService = LogisticService::firstOrCreate([
                'logistic_id' => $logisticLocal->id,
                'type' => 'Taxi Ride-hail',
            ], [
                'name' => $logisticLocal->name . ' Taksi',
                'description' => 'Anter Penumpang dengan Taksi.'
            ]);
            LogisticServiceCost::firstOrCreate([
                'logistic_service_id' => $logistService->id,
                'cost_type' => 'By Distance',
            ], [
                'cost_amount' => 5000,
                'cost_for_distance' => 1,
            ]);

            $localHasLogistic = new LocalHasLogistic();
            $allLogistic = Logistic::whereNull('local_id')->orWhere('local_id', $local->id)->orderBy('id', 'ASC')->get();
            foreach ($allLogistic as $key => $logistic) {
                $localHasLogistic->firstOrCreate([
                    'logistic_id' => $logistic->id,
                    'local_id' => $local->id,
                ], [
                    'active' => true,
                    'order' => $key
                ]);
            }

            // create customer user & detail
            $customerRole = Role::firstOrCreate([
                'name' => 'Customer',
                'guard_name' => 'api',
            ]);
            $customerUser = User::firstOrCreate(['email' => 'nuku-03@mailinator.com'], [
                'name' => 'Tupaq Claud',
                // 'email' => 'customer01@nuku.id',
                'password' => Hash::make('secret'),
                'status' => 'Active',
                'verified' => true,
            ]);
            $customerUser->assignRole($customerRole);
            $customerDetailUser = Customer::firstOrCreate(['user_id' => $customerUser->id, 'local_id' => $local->id], [
                // 'user_id' => $customerUser->id,
                // 'local_id' => $local->id,
                // 'name' => $customerUser->name,
                // 'email' => $customerUser->email,
                'avatar' => 'avatar.jpg',
                'avatar_link' => 'images/avatar.jpg',
                'phone' => '085773716731',
                // 'address' => 'Jl. Cuwiri No. 188 A'
            ]);

            $customerAddress = CustomerAddress::firstOrCreate(
                ['customer_id' => $customerDetailUser->id, 'label' => 'Rumah'],
                [
                    'recipient_name' => $customerUser->name,
                    'recipient_phone' => $customerDetailUser->phone ?? '085773716731',
                    'address' => 'Jl. Karangjati',
                    'province_id' => 10, // Jateng
                    'regency_id' => 177, //  Kabupaten Kebumen
                    'district_id' => 2496, // Sruweng
                    'postal_code' => 54362,
                    'coordinate_point' => DB::raw("POINT(123, -123346)"),
                    'coordinate_location' => 'Jl. Karangjati, Desa Sidoagung, Kecamatan Sruweng, Kabupaten Kebumen, Jawa Tengah',
                    'is_main_address' => true,
                ]
            );

            // create merchant user & detail FROM customer data
            $merchantRole = Role::firstOrCreate([
                'name' => 'Merchant',
                'guard_name' => 'api',
            ]);
            $customerUser->assignRole($merchantRole);
            $merchantLevel = MerchantLevel::firstOrCreate([
                'level' => 1,
                'name' => 'Basic Merchant',
            ]);
            $merchantDetailUser = Merchant::firstOrCreate(['user_id' => $customerUser->id, 'local_id' => $local->id], [
                // 'user_id' => $customerUser->id,
                // 'local_id' => $local->id,
                'merchant_level_id' => $merchantLevel->id,
                'name' => 'Toko Bagus',
                // 'email' => $customerUser->email,
                // 'address' => 'Jl. Cuwiri No. 188 B'
            ]);

            $merchantAddress = MerchantAddress::firstOrCreate(
                ['merchant_id' => $merchantDetailUser->id, 'label' => 'Toko'],
                [
                    'address' => 'Jl. Imogiri Timur No. xx',
                    // 'province_id' => 34,
                    // 'regency_id' => 3402,
                    // 'district_id' => 3402110,
                    // 'postal_code' => 123123,
                    'province_id' => 5, // DIY
                    'regency_id' => 501, //  Kota Yogyakarta
                    'district_id' => 6988, // Mantrijeron
                    'postal_code' => 55111,
                    'coordinate_point' => DB::raw("POINT(123, -123346)"),
                    'coordinate_location' => 'Jl. Imogiri Timur No. xx, Kecamatan Pleret, Kabupaten Bantul, D.I. Yogyakarta',
                    'is_main_address' => true,
                ]
            );
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
