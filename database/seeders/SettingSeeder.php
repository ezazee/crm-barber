<?php

namespace Database\Seeders;

use App\Models\Local;
use App\Models\LocalSetting;
use App\Models\LocalSettingCategory;
use App\Models\Setting;
use App\Models\SettingCategory;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settingSeeders = [
            /* SUPEADMIN SETTING */
            [
                'name' => 'Brand',
                'description' => null,
                'owner' => 'Head',
                'settings' => [
                    [
                        'name' => 'Logo',
                        'key' => 'logo',
                        'value' => 'path/logo.png',
                        'input_type' => 'file',
                        'data_type' => 'binary-file',
                        'description' => null,
                        'visibility' => 0, // 0: Public, 1: Interanl, 2: Private
                    ],
                    [
                        'name' => 'About',
                        'key' => 'about',
                        'value' => 'Nusantaraku adalah...',
                        'input_type' => 'text',
                        'data_type' => 'string',
                        'description' => null,
                        'visibility' => 0,
                    ],
                ]
            ],
            [
                'name' => 'Kontak',
                'description' => null,
                'owner' => 'Head',
                'settings' => [
                    [
                        'name' => 'Address',
                        'key' => 'address',
                        'value' => 'PT Nusantaraku, Jalan Pahlawan No. 1, D.I. Yogyakarta',
                        'input_type' => 'text',
                        'data_type' => 'string',
                        'description' => null,
                        'visibility' => 0,
                    ],
                    [
                        'name' => 'Phone',
                        'key' => 'phone',
                        'value' => '021-000111000',
                        'input_type' => 'text',
                        'data_type' => 'string',
                        'description' => null,
                        'visibility' => 0,
                    ],
                    [
                        'name' => 'Email',
                        'key' => 'email',
                        'value' => 'contact@nuku.com',
                        'input_type' => 'text',
                        'data_type' => 'string',
                        'description' => null,
                        'visibility' => 0,
                    ],
                ]
            ],
            [
                'name' => 'Tema Lokal',
                'description' => null,
                'owner' => 'Head',
                'settings' => [
                    [
                        'name' => 'Theme - Primary Color (Default)',
                        'key' => 'app_theme_primary_color',
                        'value' => '#1293E4',
                        'input_type' => 'text',
                        'data_type' => 'string',
                        'description' => 'Warna utama untuk tema aplikasi.',
                        'visibility' => 3,
                    ],
                    [
                        'name' => 'Theme - Secondary Color (Default)',
                        'key' => 'app_theme_secondary_color',
                        'value' => '#ffffff',
                        'input_type' => 'text',
                        'data_type' => 'string',
                        'description' => 'Warna sekunder untuk tema aplikasi.',
                        'visibility' => 3,
                    ],
                ]
            ],
            [
                'name' => 'Parameter Biaya Local',
                'description' => null,
                'owner' => 'Head',
                'settings' => [
                    [
                        'name' => 'Biaya Aplikasi (Default)',
                        'key' => 'default_convenience_fee',
                        'value' => [
                            'type' => 'Fixed',
                            'fee' => 2000,
                        ],
                        'input_type' => 'array',
                        'data_type' => 'json',
                        'description' => 'Biaya jasa aplikasi per transaksi dari Local untuk Pusat.',
                        'visibility' => 3,
                        'is_editable' => false,
                    ]
                ]
            ],

            /* LOCAL SETTING */
            [
                'name' => 'Umum',
                'owner' => 'Local',
                'settings' => [
                    [
                        'local_id' => null,
                        'name' => 'Logo',
                        'key' => 'local_logo',
                        'value' => 'uploads/locals/logo.png',
                        'input_type' => 'file | text',
                        'data_type' => 'binary | string',
                        'description' => 'Logo.',
                        'visibility' => 0,
                        'is_editable' => true,
                    ],
                    [
                        'local_id' => null,
                        'name' => 'Versi Aplikasi User',
                        'key' => 'user_app_version',
                        'value' => '1.0',
                        'input_type' => 'number',
                        'data_type' => 'float',
                        'description' => 'Versi Aplikasi User yang dianggap terbaru oleh sistem. Digunakan oleh mobile app untuk pengecekan dan notifikasi update ke user.',
                        'visibility' => 0,
                        'is_editable' => true,
                    ],
                    [
                        'local_id' => null,
                        'name' => 'Versi Aplikasi Driver',
                        'key' => 'driver_app_version',
                        'value' => '1.0',
                        'input_type' => 'number',
                        'data_type' => 'float',
                        'description' => 'Versi Aplikasi Driver yang dianggap terbaru oleh sistem. Digunakan oleh mobile app untuk pengecekan dan notifikasi update ke user.',
                        'visibility' => 0,
                        'is_editable' => true,
                    ]
                ],
            ],
            [
                'name' => 'Tema',
                'owner' => 'Local',
                'settings' => [
                    [
                        'local_id' => null,
                        'name' => 'Primary Color',
                        'key' => 'local_theme_primary_color',
                        'value' => '#1293E4',
                        'input_type' => 'text',
                        'data_type' => 'string',
                        'description' => 'Warna utama untuk tema aplikasi.',
                        'visibility' => 0,
                        'is_editable' => true,
                    ],
                    [
                        'local_id' => null,
                        'name' => 'Secondary Color',
                        'key' => 'local_theme_secondary_color',
                        'value' => '#ffffff',
                        'input_type' => 'text',
                        'data_type' => 'string',
                        'description' => 'Warna sekunder untuk tema aplikasi.',
                        'visibility' => 0,
                        'is_editable' => true,
                    ],
                ]
            ],
            [
                'name' => 'Parameter Biaya',
                'owner' => 'Local',
                'settings' => [
                    [
                        'local_id' => null,
                        'name' => 'Biaya Aplikasi',
                        'key' => 'local_convenience_fee',
                        'value' => [
                            'type' => 'Fixed',
                            'fee' => 2000,
                        ],
                        'input_type' => 'array',
                        'data_type' => 'json',
                        'description' => 'Biaya jasa aplikasi per transaksi dari Local untuk Pusat.',
                        'visibility' => 0,
                        'is_editable' => false,
                    ],
                    [
                        'local_id' => null,
                        'name' => 'Biaya Imbalan Jasa untuk Driver',
                        'key' => 'local_driver_convenience_fee',
                        'value' => [
                            'type' => 'Percent',
                            'fee' => 0.7,
                        ],
                        'input_type' => 'array',
                        'data_type' => 'json',
                        'description' => 'Biaya imbalan per transaksi dari Local untuk Driver (default: 0.7 atau 70%).',
                        'visibility' => 0,
                        'is_editable' => false,
                    ]
                ]
            ],
            [
                'name' => 'Kontak',
                'owner' => 'Local',
                'settings' => [
                    [
                        'local_id' => null,
                        'name' => 'Alamat',
                        'key' => 'address',
                        'value' => 'PT Abecede, Jalan Kaliurang KM 10 No. 63',
                        'input_type' => 'text',
                        'data_type' => 'string',
                        'description' => null,
                        'visibility' => 0,
                        'is_editable' => true,
                    ],
                    [
                        'name' => 'Nomor Telp',
                        'key' => 'telp',
                        'value' => '021-000111000',
                        'input_type' => 'text',
                        'data_type' => 'string',
                        'description' => null,
                        'visibility' => 0,
                        'is_editable' => true,
                    ],
                    [
                        'name' => 'Nomor HP/Whatsapp',
                        'key' => 'phone',
                        'value' => '6285712341234',
                        'input_type' => 'text',
                        'data_type' => 'string',
                        'description' => 'Wajib dimulai dengan kode negara (62).',
                        'visibility' => 0,
                        'is_editable' => true,
                    ],
                    [
                        'name' => 'Email',
                        'key' => 'email',
                        'value' => 'info@abecede.com',
                        'input_type' => 'text',
                        'data_type' => 'string',
                        'description' => null,
                        'visibility' => 0,
                        'is_editable' => true,
                    ],
                ]
            ],
        ];

        $locals = Local::all();
        $settingCategoryModel = new SettingCategory();
        $settingModel = new Setting();
        $localSettingCategoryModel = new LocalSettingCategory();
        $localSettingModel = new LocalSetting();

        $localSettingModel->where('key', 'app_version')->delete();

        foreach ($settingSeeders as $key => $settingCategory) {

            if ($settingCategory['owner'] == 'Head') {
                $settingCategoryCreatedData = $settingCategoryModel->firstOrCreate([
                    'name' => $settingCategory['name']
                ], [
                    'description' => $settingCategory['description'] ?? null
                ]);
            } else {
                $settingCategoryCreatedData = $localSettingCategoryModel->firstOrCreate([
                    'name' => $settingCategory['name']
                ], [
                    'description' => $settingCategory['description'] ?? null,
                ]);
            }

            if ($settingCategoryCreatedData) {
                foreach ($settingCategory['settings'] as $key2 => $setting) {

                    $settingValue = '';
                    if ($setting['data_type'] == 'json') {
                        $settingValue = json_encode($setting['value']);
                    } else {
                        $settingValue = $setting['value'];
                    }

                    if ($settingCategory['owner'] == 'Head') {
                        $settingModel->firstOrCreate([
                            'key' => $setting['key'],
                        ], [
                            'name' => $setting['name'],
                            'value' => $settingValue,
                            'input_type' => $setting['input_type'],
                            'data_type' => $setting['data_type'],
                            'description' => $setting['description'],
                            'setting_category_id' => $settingCategoryCreatedData->id
                        ]);
                    } else if ($settingCategory['owner'] == 'Local') {
                        foreach ($locals as $key3 => $local) {
                            $localSettingModel->firstOrCreate([
                                'local_id' => $local->id,
                                'key' => $setting['key']
                            ], [
                                'name' => $setting['name'],
                                'value' => $settingValue,
                                'input_type' => $setting['input_type'],
                                'data_type' => $setting['data_type'],
                                'description' => $setting['description'],
                                'is_editable' => $setting['is_editable'] ?? true,
                                'local_setting_category_id' => $settingCategoryCreatedData->id
                            ]);
                        }
                    }
                }
            }
        }
    }
}
