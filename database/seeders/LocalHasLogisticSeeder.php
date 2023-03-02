<?php

namespace Database\Seeders;

use App\Models\Local;
use App\Models\LocalHasLogistic;
use App\Models\Logistic;
use App\Models\LogisticService;
use App\Models\LogisticServiceCost;
use App\Models\Province;
use Illuminate\Database\Seeder;

class LocalHasLogisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locals = Local::all();
        foreach ($locals as $key => $local) {

            // check if local have not local logistic yet
            $checkCount = Logistic::where('local_id', $local->id)->count();
            if ($checkCount < 1) {
                // Local > Logistic
                $logisticLocal = Logistic::firstOrCreate([
                    'name' => 'Nuku Delivery',
                    'short_name' => 'Nuku Delivery',
                    'code' => 'delivery-' . $local->id,
                    'scope' => 'Local',
                    'source' => 'Local System',
                    'local_id' => $local->id,
                    'image_file' => 'images/icon-placeholder-2.jpg',
                    'image_file_link' => url('images/icon-placeholder-2.jpg'),
                ]);

                // $logistService = LogisticService::firstOrCreate([
                //     'logistic_id' => $logisticLocal->id,
                //     'name' => $logisticLocal->name . ' Reguler',
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
                    'name' => $logisticLocal->name . ' Kirimin',
                    'type' => 'Instant',
                    'description' => 'Kirimin Barang Instan',
                ]);
                $logisticServiceCost = LogisticServiceCost::firstOrCreate([
                    'logistic_service_id' => $logistService->id,
                    'cost_type' => 'By Distance',
                    'cost_amount' => 3000,
                    'cost_for_distance' => 1,
                ]);
                if ($logisticServiceCost->cost_type == 'Distance') {
                    // add additional
                    $logisticServiceCost->update([
                        'additional' => [
                            'instant_courier_settings' => [
                                'cost_flat_amount' => 1900,
                                'cost_flat_distance' => 1,
                                'cost_min_amount' => 9600,
                                'cost_min_distance' => 4,
                            ]
                        ]
                    ]);
                }

                // $logistService = LogisticService::firstOrCreate([
                //     'logistic_id' => $logisticLocal->id,
                //     'name' => $logisticLocal->name . ' Anterin',
                //     'type' => 'Ride-hailing',
                //     'description' => 'Anter Penumpang dengan Mudah',
                // ]);
                // LogisticServiceCost::firstOrCreate([
                //     'logistic_service_id' => $logistService->id,
                //     'cost_type' => 'By Distance',
                //     'cost_amount' => 4800,
                //     'cost_for_distance' => 1,
                // ]);

                $localHasLogistic = new LocalHasLogistic();
                $allLogistic = Logistic::whereNull('local_id')->orWhere('local_id', $local->id)->orderBy('id', 'ASC')->get();
                foreach ($allLogistic as $key => $logistic) {
                    $localHasLogistic->firstOrCreate([
                        'logistic_id' => $logistic->id,
                        'local_id' => $local->id,
                        'active' => true,
                        'order' => $key
                    ]);
                }
            }
        }
    }
}
