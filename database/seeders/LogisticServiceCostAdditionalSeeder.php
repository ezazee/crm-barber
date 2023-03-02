<?php

namespace Database\Seeders;

use App\Models\LogisticServiceCost;
use Illuminate\Database\Seeder;

class LogisticServiceCostAdditionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $logisticServiceCostData = LogisticServiceCost::where('cost_type', 'By Distance')
            ->whereNull('additional')
            ->get();
        foreach ($logisticServiceCostData as $key => $logisticServiceCost) {
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
    }
}
