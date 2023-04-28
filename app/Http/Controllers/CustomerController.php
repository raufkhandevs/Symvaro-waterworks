<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function userMeterReadings(Customer $customer)
    {
        return new CustomerResource($customer->load(['user', 'waterMeters.meterReadings.attachments']));
    }
}
