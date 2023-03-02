<?php

namespace Database\Seeders;

use App\Models\Local;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
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
                'name' => 'Buku',
                'description' => null,
                'childs' => [
                    [
                        'name' => 'Ekonomi & Bisnis',
                        'description' => null,
                        'childs' => [
                            [
                                'name' => 'Buku Akuntansi',
                                'description' => null,
                                'childs' => null
                            ],
                            [
                                'name' => 'Buku Bisnis',
                                'description' => null,
                                'childs' => null
                            ],
                            [
                                'name' => 'Buku Ekonomi',
                                'description' => null,
                                'childs' => null
                            ],
                            [
                                'name' => 'Buku Manajemen',
                                'description' => null,
                                'childs' => null
                            ],
                        ]
                    ],
                    [
                        'name' => 'Novel & Sastra',
                        'description' => null,
                        'childs' => [
                            [
                                'name' => 'Buku Roman',
                                'description' => null,
                                'childs' => null
                            ],
                            [
                                'name' => 'Fantasi',
                                'description' => null,
                                'childs' => null
                            ],
                            [
                                'name' => 'Fiksi Puisi',
                                'description' => null,
                                'childs' => null
                            ],
                            [
                                'name' => 'Novel Remaja',
                                'description' => null,
                                'childs' => null
                            ],
                        ]
                    ],
                    [
                        'name' => 'Pengembangan Diri & Karir',
                        'description' => null,
                        'childs' => [
                            [
                                'name' => 'Buku Leadership & Kepemimpinan',
                                'description' => null,
                                'childs' => null
                            ],
                            [
                                'name' => 'Buku Kesuksesan',
                                'description' => null,
                                'childs' => null
                            ],
                            [
                                'name' => 'Self Improvement & Development',
                                'description' => null,
                                'childs' => null
                            ],
                        ]
                    ],
                    [
                        'name' => 'Lainnya',
                        'description' => null,
                        'childs' => null
                    ]
                ]
            ],
            [
                'name' => 'Dapur',
                'description' => null,
                'childs' => [
                    [
                        'name' => 'Aksesoris Dapur',
                        'description' => null,
                        'childs' => [
                            [
                                'name' => 'Capit Makanan',
                                'description' => null,
                                'childs' => null
                            ],
                            [
                                'name' => 'Celemek',
                                'description' => null,
                                'childs' => null
                            ],
                            [
                                'name' => 'Magnet Kulkas',
                                'description' => null,
                                'childs' => null
                            ],
                            [
                                'name' => 'Parutan',
                                'description' => null,
                                'childs' => null
                            ],
                        ]
                    ],
                    [
                        'name' => 'Peralatan Masak',
                        'description' => null,
                        'childs' => [
                            [
                                'name' => 'Cetakan Es, Puding, Coklat',
                                'description' => null,
                                'childs' => null
                            ],
                            [
                                'name' => 'Cobek',
                                'description' => null,
                                'childs' => null
                            ],
                            [
                                'name' => 'Deep Fryer',
                                'description' => null,
                                'childs' => null
                            ],
                            [
                                'name' => 'Gelas Takar',
                                'description' => null,
                                'childs' => null
                            ],
                            [
                                'name' => 'Kompor',
                                'description' => null,
                                'childs' => null
                            ],
                            [
                                'name' => 'Panci',
                                'description' => null,
                                'childs' => null
                            ],
                        ]
                    ],
                    [
                        'name' => 'Penyimpanan Makanan',
                        'description' => null,
                        'childs' => [
                            [
                                'name' => 'Alumunium Foil',
                                'description' => null,
                                'childs' => null
                            ],
                            [
                                'name' => 'Box Telur',
                                'description' => null,
                                'childs' => null
                            ],
                            [
                                'name' => 'Cooler Box',
                                'description' => null,
                                'childs' => null
                            ],
                            [
                                'name' => 'Tempat Bumbu',
                                'description' => null,
                                'childs' => null
                            ],
                            [
                                'name' => 'Tempat Buah & Sayur',
                                'description' => null,
                                'childs' => null
                            ],
                            [
                                'name' => 'Toples',
                                'description' => null,
                                'childs' => null
                            ],
                        ]
                    ],
                    [
                        'name' => 'Lainnya',
                        'description' => null,
                        'childs' => null
                    ]
                ]
            ],
            [
                'name' => 'Lainnya',
                'description' => null,
                'childs' => null
            ]
        ];

        $locals = Local::all();
        foreach ($locals as $local) {
            foreach ($data as $key => $dataRow) {
                $dataRow['local_id'] = $local->id;
                $this->insertData($dataRow, null, 1);
            }
        }
    }

    function insertData($data = [], $parentId = null, $depth = 1)
    {
        if (!empty($data)) {
            $category = ProductCategory::firstOrCreate(
                [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'parent_id' => $parentId,
                    'depth_level' => $depth,
                    'local_id' => $data['local_id']
                ]
            );
            $depth++;
            $data = is_array($data['childs']) ? $data['childs'] : [];
            foreach ($data as $key => $dataRow) {
                $dataRow['local_id'] = $category->local_id;
                $this->insertData($dataRow, $category->id, $depth);
            }
        }
    }
}
