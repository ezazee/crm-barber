<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\CouponCode;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
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
                'label' => 'Promo BIG SALE 7.7',
                'description' => 'description here',
                'discount_type' => 'Percent',
                'discount_amount' => 0.07, // 7 %
                'start_datetime' => '2022-07-07 00:00:00',
                'end_datetime' => '2022-08-07 00:00:00',
                'quota_type' => 'Unlimited',
                'quota_origin' => null,
                'quota_current' => null,
                'usage_type' => 'Multiple-time Use',
                'cut_type' => 'Billing',
                'minimum_cart_price' => 50000,
                'maximum_cut_price' => 20000,
                'merchant_id' => null,
                'local_id' => null,
                'coupon_codes' => [
                    [
                        'code' => 'BIGSALE77',
                        'code_used' => 0,
                    ],
                    [
                        'code' => '77DUARRR',
                        'code_used' => 0,
                    ]
                ]
            ],
            [
                'label' => 'Potongan Ongkir 20%',
                'description' => 'description here',
                'discount_type' => 'Percent',
                'discount_amount' => 0.2, // 20 %
                'start_datetime' => '2022-07-07 00:00:00',
                'end_datetime' => '2022-08-07 00:00:00',
                'quota_type' => 'Quota',
                'quota_origin' => 50,
                'quota_current' => 40,
                'usage_type' => 'One-time Use',
                'cut_type' => 'Shipping',
                'minimum_cart_price' => 50000,
                'maximum_cut_price' => 10000,
                'merchant_id' => null,
                'local_id' => null,
                'coupon_codes' => [
                    [
                        'code' => 'ONGKIR20',
                        'code_used' => 10,
                    ],
                ]
            ],
        ];

        foreach ($data as $dataRow) {
            $couponCodes = $dataRow['coupon_codes'];
            unset($dataRow['coupon_codes']);
            $coupon = Coupon::firstOrCreate([
                'label' => $dataRow['label'],
                'discount_type' => $dataRow['discount_type'],
                'discount_amount' => $dataRow['discount_amount']
            ], $dataRow);
            foreach ($couponCodes as $couponCode) {
                $couponCode = CouponCode::firstOrCreate([
                    'coupon_id' => $coupon->id, 'code' => $couponCode['code']
                ], $couponCode);
            }
        }
    }
}
