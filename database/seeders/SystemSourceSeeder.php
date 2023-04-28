<?php

namespace Database\Seeders;

use App\Models\SystemSource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createSystemSource($this->prepareSystemSourceData());
    }

    public function createSystemSource($sources)
    {
        foreach ($sources as $source) {
            try {
                SystemSource::create($source);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }

    public function prepareSystemSourceData()
    {
        return [
            [
                'name' => 'web',
                'source_ip' => '192.125.458.154'
            ],
            [
                'name' => 'app',
                'source_ip' => '192.125.458.112'
            ],
            [
                'name' => 'mail',
                'source_ip' => '192.125.458.341'
            ],
        ];
    }
}
