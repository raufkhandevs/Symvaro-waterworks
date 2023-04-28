<?php

namespace Database\Seeders;

use App\Models\MeterReading;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeterReadingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createMeterReading($this->prepareMeterReadingData());
    }

    protected function createMeterReading($meterReading)
    {
        foreach ($meterReading as $reading) {
            try {
                MeterReading::create($reading);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }

    protected function prepareMeterReadingData()
    {
        return [
            [
                'water_meter_id' => 1,
                'source_id' => 1,
                'date' => now()->subDays(100),
                'reading' => rand(5, 999),
            ],

            [
                'water_meter_id' => 1,
                'source_id' => 1,
                'date' => now()->subDays(100),
                'reading' => rand(5, 999),
            ],

            [
                'water_meter_id' => 1,
                'source_id' => 2,
                'date' => now()->subDays(200),
                'reading' => rand(5, 999),
            ],

            [
                'water_meter_id' => 2,
                'source_id' => 2,
                'date' => now()->subDays(300),
                'reading' => rand(5, 999),
            ],
        ];
    }
}
