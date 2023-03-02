<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use App\Utils\ApiRajaongkir;
use App\Utils\ApiWilayah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\UuidFactory;

class RegionSeeder extends Seeder
{
    protected $source = 'apiRajaongkir';
    protected $fresh = false;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        switch ($this->source) {
            case 'apiWilayah':
                $this->_generateFromApiWilayah();
                break;
            case 'apiRajaongkir':
                $this->_generateFromApiRajaOngkir();
                break;
            default:
                echo 'source not defined' . PHP_EOL;
                break;
        }
    }

    function _generateFromApiWilayah()
    {
        DB::beginTransaction();
        if ($this->fresh) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('villages')->truncate();
            DB::table('districts')->truncate();
            DB::table('regencies')->truncate();
            DB::table('provinces')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
        if (Province::get()->count() < 1) {
            try {
                $apiWilayah = new ApiWilayah();
                $provinsiData = $apiWilayah->getProvinsi();
                foreach ($provinsiData as $provinsiDataRow) {

                    $province = Province::firstOrCreate([
                        'id' => $provinsiDataRow['id'],
                        'name' => $provinsiDataRow['nama'],
                    ]);

                    $kotaData = $apiWilayah->getKota($province->id);
                    foreach ($kotaData as $kotaDataRow) {
                        $regency = Regency::firstOrCreate([
                            'id' => $kotaDataRow['id'],
                            'name' => $kotaDataRow['nama'],
                            'province_id' => $province->id,
                        ]);

                        $kecamatanData = $apiWilayah->getKecamatan($regency->id);
                        foreach ($kecamatanData as $kecamatanDataRow) {
                            $district = District::firstOrCreate([
                                'id' => $kecamatanDataRow['id'],
                                'name' => $kecamatanDataRow['nama'],
                                'regency_id' => $regency->id,
                            ]);
                        }
                    }
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        }
    }

    function _generateFromApiRajaOngkir()
    {
        DB::beginTransaction();
        if ($this->fresh) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('villages')->truncate();
            DB::table('districts')->truncate();
            DB::table('regencies')->truncate();
            DB::table('provinces')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
        if (Province::get()->count() < 1) {
            try {
                $apiRajaongkir = new ApiRajaongkir();
                $provinceData = $apiRajaongkir->getProvinces();
                foreach ($provinceData as $provinceDataRow) {

                    $province = Province::firstOrCreate([
                        'id' => $provinceDataRow['province_id'],
                        'name' => $provinceDataRow['province'],
                    ]);

                    $kotaData = $apiRajaongkir->getCities($province->id);
                    foreach ($kotaData as $kotaDataRow) {
                        $regency = Regency::firstOrCreate([
                            'id' => $kotaDataRow['city_id'],
                            'type' => $kotaDataRow['type'],
                            'name' => $kotaDataRow['city_name'],
                            'postal_code' => $kotaDataRow['postal_code'],
                            'province_id' => $province->id,
                        ]);

                        $kecamatanData = $apiRajaongkir->getSubdistricts($regency->id);
                        foreach ($kecamatanData as $kecamatanDataRow) {
                            $district = District::firstOrCreate([
                                'id' => $kecamatanDataRow['subdistrict_id'],
                                'name' => $kecamatanDataRow['subdistrict_name'],
                                'regency_id' => $regency->id,
                            ]);
                        }
                    }
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        }
    }
}
