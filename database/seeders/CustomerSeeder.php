<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createCustomers($this->prepareCustomerData());
    }

    protected function createCustomers($customers)
    {
        foreach ($customers as $customer) {
            try {
                Customer::create($customer);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }

    protected function prepareCustomerData()
    {
        return  [
            [
                'user_id' => 2,
                'customer_code' =>  Str::random(15),
            ],
            [
                'user_id' => 3,
                'customer_code' =>  Str::random(15),
            ],
            [
                'user_id' => 4,
                'customer_code' =>  Str::random(15),
            ],
            [
                'user_id' => 5,
                'customer_code' =>  Str::random(15),
            ],
            [
                'user_id' => 6,
                'customer_code' =>  Str::random(15),
            ],
        ];
    }
}
