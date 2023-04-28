<?php

namespace Database\Seeders;

use App\Models\WaterMeter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaterMeterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createWanterMeters($this->prepareWaterMeterData());
    }

    protected function createWanterMeters($waterMeters)
    {
        foreach ($waterMeters as $meter) {
            try {
                WaterMeter::create($meter);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }

    protected function prepareWaterMeterData()
    {
        return [
            [
                'customer_id' => 1,
                'meter_number' => rand(9999, 9999999),
                'location' => 'Ist Flr. Hill View Plaza, 76-E, Jinnah Avenue',
            ],
            [
                'customer_id' => 1,
                'meter_number' => rand(9999, 9999999),
                'location' => 'Dhoraji Colony',
            ],
            [
                'customer_id' => 2,
                'meter_number' => rand(9999, 9999999),
                'location' => 'Danapur Road, G.O.R.-1, Lahore',
            ],
            [
                'customer_id' => 3,
                'meter_number' => rand(9999, 9999999),
                'location' => 'Blenkin Street, Saddar',
            ],
            [
                'customer_id' => 4,
                'meter_number' => rand(9999, 9999999),
                'location' => 'P.I.B Colony',
            ],
            [
                'customer_id' => 5,
                'meter_number' => rand(9999, 9999999),
                'location' => '106, Commerce Centre Hasrat Mohani Road',
            ],
            [
                'customer_id' => 6,
                'meter_number' => rand(9999, 9999999),
                'location' => 'Blenkin Street, Saddar',
            ],
            [
                'customer_id' => 5,
                'meter_number' => rand(9999, 9999999),
                'location' => '106, Commerce Centre Hasrat Mohani Road',
            ],
            [
                'customer_id' => 5,
                'meter_number' => rand(9999, 9999999),
                'location' => 'Ist Flr. Hill View Plaza, 76-E, Jinnah Avenue',
            ],
            [
                'customer_id' => 5,
                'meter_number' => rand(9999, 9999999),
                'location' => 'Ist Flr. Hill View Plaza, 76-E, Jinnah Avenue',
            ],
        ];
    }
}
