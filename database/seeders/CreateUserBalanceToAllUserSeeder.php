<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserBalance;
use Illuminate\Database\Seeder;

class CreateUserBalanceToAllUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        $type = '';
        $local_id = '';
        foreach ($users as $key => $user) {
            $profile = User::with(['customer', 'merchant', 'driver'])->find($user->id);
            if ($profile->customer) {
                $type = 'Customer';
                $local_id = $profile->customer->local_id;
            } else if ($profile->driver) {
                $type = 'Driver';
                $local_id = $profile->driver->local_id;
            }
            echo $type . PHP_EOL;
            if ($profile && $local_id) {
                $createdData = UserBalance::firstOrCreate([
                    'local_id' => $local_id,
                    'user_id' => $user->id,
                    'user_type' => $type,
                ], [
                    'balance_total' => 0,
                ]);
                if ($type == 'Customer' && $createdData) {
                    echo 'Merchant' . PHP_EOL;
                    UserBalance::firstOrCreate([
                        'local_id' => $local_id,
                        'user_id' => $user->id,
                        'user_type' => 'Merchant',
                    ], [
                        'balance_total' => 0,
                    ]);
                }
            }
        }
    }
}
