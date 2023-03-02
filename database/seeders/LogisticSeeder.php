<?php

namespace Database\Seeders;

use App\Models\Logistic;
use App\Models\LogisticService;
use Illuminate\Database\Seeder;

class LogisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Jalur Nugraha Ekakurir',
                'short_name' => 'JNE',
                'code' => 'jne',
                'scope' => 'National',
                'source' => 'Third Party',
                'image_file' => 'images/icon-placeholder-2.jpg',
                'image_file_link' => url('images/icon-placeholder-2.jpg'),
                'services' => [
                    [
                        'name' => 'REG',
                        'type' => 'Reguler',
                        'description' => 'Layanan Reguler',
                    ],
                    [
                        'name' => 'OKE',
                        'type' => 'Economy',
                        'description' => 'Ongkos Kirim Ekonomis',
                    ]
                ]
            ],
            [
                'name' => 'POS Indonesia',
                'short_name' => 'POS',
                'code' => 'pos',
                'scope' => 'National',
                'source' => 'Third Party',
                'image_file' => 'images/icon-placeholder-2.jpg',
                'image_file_link' => url('images/icon-placeholder-2.jpg'),
                'services' => [
                    [
                        'name' => 'Paket Kilat Khusus',
                        'type' => 'Reguler',
                        'description' => 'Paket Kilat Khusus',
                    ],
                ]
            ],
            [
                'name' => 'J&T Express',
                'short_name' => 'J&T',
                'code' => 'jnt',
                'scope' => 'National',
                'source' => 'Third Party',
                'image_file' => 'images/icon-placeholder-2.jpg',
                'image_file_link' => url('images/icon-placeholder-2.jpg'),
                'services' => [
                    [
                        'name' => 'EZ',
                        'type' => 'Reguler',
                        'description' => 'Reguler Service',
                    ],
                ]
            ],
            [
                'name' => 'Citra Van Titipan Kilat',
                'short_name' => 'TIKI',
                'code' => 'tiki',
                'scope' => 'National',
                'source' => 'Third Party',
                'image_file' => 'images/icon-placeholder-2.jpg',
                'image_file_link' => url('images/icon-placeholder-2.jpg'),
                'services' => [
                    [
                        'name' => 'ECO',
                        'type' => 'Economy',
                        'description' => 'Economy Service',
                    ],
                    [
                        'name' => 'REG',
                        'type' => 'Reguler',
                        'description' => 'Reguler Service',
                    ],
                ]
            ],
            [
                'name' => 'Wahana Prestasi Logistik',
                'short_name' => 'Wahana',
                'code' => 'wahana',
                'scope' => 'National',
                'source' => 'Third Party',
                'image_file' => 'images/icon-placeholder-2.jpg',
                'image_file_link' => url('images/icon-placeholder-2.jpg'),
                'services' => [
                    [
                        'name' => 'Normal',
                        'type' => 'Economy',
                        'description' => 'Normal Service',
                    ],
                ]
            ],
        ];

        foreach ($data as $dataRow) {
            $services = $dataRow['services'];
            unset($dataRow['services']);
            $dataRow['type'] = 'Shipping';
            $logistic = Logistic::firstOrCreate(['code' => $dataRow['code']], $dataRow);
            foreach ($services as $service) {
                $logisticService = LogisticService::firstOrCreate([
                    'logistic_id' => $logistic->id, 'name' => $service['name']
                ], [
                    'logistic_id' => $logistic->id,
                    'name' => $service['name'],
                    'type' => $service['type'],
                    'description' => $service['description'],
                ]);
            }
        }
    }
}
