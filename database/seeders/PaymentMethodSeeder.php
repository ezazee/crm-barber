<?php

namespace Database\Seeders;

use App\Libraries\PaymentGatewayLibrary;
use App\Libraries\PaymentLibrary;
use App\Models\Local;
use App\Models\LocalHasPaymentMethod;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    public $fresh = false;
    protected $vendor = 'tripay';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        if ($this->fresh == true) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('local_has_payment_methods')->truncate();
            DB::table('payment_methods')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
        try {
            $this->seedMidtransData();
            $this->seedTripayData();
            // switch ($this->vendor) {
            //     case 'tripay':
            //         $this->seedTripayData();
            //         break;
            //     case 'midtrans':
            //         $this->seedMidtransData();
            //         break;
            //     default:
            //         break;
            // }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    function seedMidtransData()
    {
        $data = [
            [
                'name' => 'Bank Transfer (Manual Confirmation)',
                'code' => 'bank_transfer_manual',
                'group' => 'Bank Transfer',
                'minimum_payment' => 10000,
                'fee_type' => 'Fixed',
                'fee' => 6500,
                'is_third_party' => false,
                'active' => true,
                'image_file' => 'images/icon-placeholder-1.jpg',
                'image_file_link' => url('images/icon-placeholder-1.jpg'),
                'payment_gateway_vendor' => null,
            ],
            [
                'name' => 'Balance',
                'code' => 'balance',
                'group' => 'Balance',
                'minimum_payment' => 1000,
                'fee_type' => 'Fixed',
                'fee' => 0,
                'is_third_party' => false,
                'active' => true,
                'image_file' => 'images/icon-placeholder-1.jpg',
                'image_file_link' => url('images/icon-placeholder-1.jpg'),
                'payment_gateway_vendor' => null,
            ],
            [
                'name' => 'Cash on Delivery (COD)',
                'code' => 'cod',
                'group' => 'Cash on Delivery',
                'minimum_payment' => 10000,
                'fee_type' => 'Percent',
                'fee' => 0,
                'is_third_party' => false,
                'active' => true,
                'image_file' => 'images/icon-placeholder-1.jpg',
                'image_file_link' => url('images/icon-placeholder-1.jpg'),
                'payment_gateway_vendor' => null,
            ],
            [
                'name' => 'BCA Virtual Account',
                'code' => 'bca',
                'group' => 'Virtual Account',
                'minimum_payment' => 10000,
                'fee_type' => 'Percent',
                'fee' => 0.02,
                'is_third_party' => true,
                'active' => true,
                'image_file' => 'images/icon-placeholder-1.jpg',
                'image_file_link' => url('images/icon-placeholder-1.jpg'),
                'payment_gateway_vendor' => 'Midtrans',
            ],
            [
                'name' => 'BNI Virtual Account',
                'code' => 'bni',
                'group' => 'Virtual Account',
                'minimum_payment' => 10000,
                'fee_type' => 'Percent',
                'fee' => 0.02,
                'is_third_party' => true,
                'active' => true,
                'image_file' => 'images/icon-placeholder-1.jpg',
                'image_file_link' => url('images/icon-placeholder-1.jpg'),
                'payment_gateway_vendor' => 'Midtrans',
            ],
            [
                'name' => 'BRI Virtual Account',
                'code' => 'bri',
                'group' => 'Virtual Account',
                'minimum_payment' => 10000,
                'fee_type' => 'Percent',
                'fee' => 0.02,
                'is_third_party' => true,
                'active' => true,
                'image_file' => 'images/icon-placeholder-1.jpg',
                'image_file_link' => url('images/icon-placeholder-1.jpg'),
                'payment_gateway_vendor' => 'Midtrans',
            ],
            [
                'name' => 'Mandiri Bill Payment',
                'code' => 'mandiri',
                'group' => 'e-Channel',
                'minimum_payment' => 10000,
                'fee_type' => 'Percent',
                'fee' => 0.02,
                'is_third_party' => true,
                'active' => true,
                'image_file' => 'images/icon-placeholder-1.jpg',
                'image_file_link' => url('images/icon-placeholder-1.jpg'),
                'payment_gateway_vendor' => 'Midtrans',
            ],
            // [
            //     'name' => 'Permata Virtual Account',
            //     'code' => 'permata_va',
            //     'group' => 'Virtual Account',
            //     'minimum_payment' => 10000,
            //     'fee_type' => 'Percent',
            //     'fee' => 0.02,
            //     'is_third_party' => true,
            //     'active' => true,
            // ],
            [
                'name' => 'GoPay',
                'code' => 'gopay',
                'group' => 'e-Money',
                'minimum_payment' => 10000,
                'fee_type' => 'Percent',
                'fee' => 0.02,
                'is_third_party' => true,
                'active' => true,
                'image_file' => 'images/icon-placeholder-1.jpg',
                'image_file_link' => url('images/icon-placeholder-1.jpg'),
                'payment_gateway_vendor' => 'Midtrans',
            ],
            [
                'name' => 'BCA KlikPay',
                'code' => 'bca_klikpay',
                'group' => 'Direct Debit',
                'minimum_payment' => 10000,
                'fee_type' => 'Fixed',
                'fee' => 5000,
                'is_third_party' => true,
                'active' => true,
                'image_file' => 'images/icon-placeholder-1.jpg',
                'image_file_link' => url('images/icon-placeholder-1.jpg'),
                'payment_gateway_vendor' => 'Midtrans',
            ],
            [
                'name' => 'CIMB Clicks',
                'code' => 'cimb_clicks',
                'group' => 'Direct Debit',
                'minimum_payment' => 10000,
                'fee_type' => 'Fixed',
                'fee' => 5000,
                'is_third_party' => true,
                'active' => true,
                'image_file' => 'images/icon-placeholder-1.jpg',
                'image_file_link' => url('images/icon-placeholder-1.jpg'),
                'payment_gateway_vendor' => 'Midtrans',
            ],
            [
                'name' => 'Danamon Online Banking',
                'code' => 'danamon_online',
                'group' => 'Direct Debit',
                'minimum_payment' => 10000,
                'fee_type' => 'Fixed',
                'fee' => 5000,
                'is_third_party' => true,
                'active' => true,
                'image_file' => 'images/icon-placeholder-1.jpg',
                'image_file_link' => url('images/icon-placeholder-1.jpg'),
                'payment_gateway_vendor' => 'Midtrans',
            ],
            [
                'name' => 'BRImo',
                'code' => 'bri_epay',
                'group' => 'Direct Debit',
                'minimum_payment' => 10000,
                'fee_type' => 'Fixed',
                'fee' => 5000,
                'is_third_party' => true,
                'active' => true,
                'image_file' => 'images/icon-placeholder-1.jpg',
                'image_file_link' => url('images/icon-placeholder-1.jpg'),
                'payment_gateway_vendor' => 'Midtrans',
            ],
        ];

        $localData = Local::all();

        foreach ($data as $key => $dataRow) {
            $dataRow['order'] = $key;
            $paymentMethod = PaymentMethod::firstOrCreate([
                'name' => $dataRow['name'],
                'code' => $dataRow['code'],
            ], $dataRow);

            foreach ($localData as $localDataRow) {
                LocalHasPaymentMethod::firstOrCreate([
                    'local_id' => $localDataRow->id,
                    'payment_method_id' => $paymentMethod->id,
                ], [
                    'name' => $paymentMethod->name,
                    'active' => $paymentMethod->active,
                    'order' => $paymentMethod->order,
                ]);
            }
        }
    }

    function seedTripayData()
    {
        $config = ['vendor' => 'tripay'];
        $tripay = new PaymentGatewayLibrary($config);
        $data = $tripay->getChannels()->getData();
        // print_r($data);

        $localData = Local::all();

        $customMethods = [
            [
                'name' => 'Cash on Delivery (COD)',
                'code' => 'cod',
                'group' => 'Cash on Delivery',
                'minimum_payment' => 10000,
                'fee_type' => 'Percent',
                // 'fee' => 0.03,
                'fee' => 0,
                'is_third_party' => false,
                'active' => true,
                'image_file' => 'images/icon-placeholder-1.jpg',
                'image_file_link' => url('images/icon-placeholder-1.jpg'),
                'payment_gateway_vendor' => null,
            ],
        ];

        $orderNumber = 0;
        foreach ($customMethods as $key => $customMethodsRow) {
            $customMethodsRow['order'] = $orderNumber;
            $paymentMethod = PaymentMethod::firstOrCreate([
                'name' => $customMethodsRow['name'],
                'code' => $customMethodsRow['code'],
            ], $customMethodsRow);

            foreach ($localData as $localDataRow) {
                LocalHasPaymentMethod::firstOrCreate([
                    'local_id' => $localDataRow->id,
                    'payment_method_id' => $paymentMethod->id,
                ], [
                    'name' => $paymentMethod->name,
                    'active' => $paymentMethod->active,
                    'order' => $paymentMethod->order,
                ]);
            }

            $orderNumber++;
        }


        foreach ($data as $key => $dataRow) {

            switch ($dataRow->code) {
                case 'ALFAMART':
                case 'ALFAMIDI':
                    $minimumPayment = 5000;
                    break;
                case 'OVO':
                case 'QRIS':
                case 'QRISC':
                case 'QRISD':
                    $minimumPayment = 1000;
                    break;
                default:
                    $minimumPayment = 10000;
                    break;
            }

            $fee = 0;
            $feeType = 'Fixed';
            $feeAdditional = null;
            $feeAdditionalType = null;
            if ($dataRow->total_fee) {
                if ($dataRow->total_fee->flat > 0) {
                    $feeType = 'Fixed';
                    $fee = $dataRow->total_fee->flat;
                } else if ($dataRow->total_fee->percent > 0) {
                    $feeType = 'Percent';
                    $fee = $dataRow->total_fee->percent;
                }

                if ($dataRow->total_fee->flat > 0 && $dataRow->total_fee->percent > 0) {
                    $feeType = 'Fixed';
                    $fee = $dataRow->total_fee->flat;
                    $feeAdditional = $dataRow->total_fee->percent / 100;
                    $feeAdditionalType = 'Percent';
                }
            }

            if ($dataRow->code === 'INDOMARET') {
                if (!$feeAdditional) {
                    $feeAdditional = 0;
                }
                $feeAdditional += 3000;
            }

            $path = parse_url($dataRow->icon_url, PHP_URL_PATH);
            $basename = basename($path);

            if ($dataRow->active) {
                $paymentMethod = PaymentMethod::firstOrCreate([
                    'name' => $dataRow->name,
                    'code' => $dataRow->code,
                ], [
                    'name' => $dataRow->name,
                    'group' => $dataRow->group,
                    'code' => $dataRow->code,
                    'minimum_payment' => $minimumPayment,
                    'fee_type' => $feeType,
                    'fee' => $fee,
                    'fee_additional' => $feeAdditional,
                    'fee_additional_type' => $feeAdditionalType,
                    'is_third_party' => true,
                    'active' => $dataRow->active,
                    'image_file' => $basename,
                    'image_file_link' => $dataRow->icon_url,
                    'payment_gateway_vendor' => 'Tripay',
                    'order' => $orderNumber
                ]);

                foreach ($localData as $localDataRow) {
                    LocalHasPaymentMethod::firstOrCreate([
                        'local_id' => $localDataRow->id,
                        'payment_method_id' => $paymentMethod->id,
                    ], [
                        'name' => $paymentMethod->name,
                        'active' => $paymentMethod->active,
                        'order' => $paymentMethod->order,
                    ]);
                }

                $orderNumber++;
            }
        }
    }
}
