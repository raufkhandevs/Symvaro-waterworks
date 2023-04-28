<?php

namespace App\Services;

use App\Models\WaterMeter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WaterMeterService
{
    public function createWaterMeter(Request $request, MeterReadingService $meterReadingService)
    {
        $waterMeterRequest = $request->validated();

        try {

            DB::beginTransaction();

            $waterMeter = WaterMeter::create($waterMeterRequest);

            if ($meterReadings = $waterMeterRequest['meter_readings']) {
                $meterReadingService->createBulkMeterReading($meterReadings, $waterMeter);
            }

            DB::commit();

            return $waterMeter;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }

    public function updateWaterMeter(Request $request, WaterMeter $waterMeter, MeterReadingService $meterReadingService)
    {
        $waterMeterRequest = $request->validated();

        try {
            DB::beginTransaction();

            $newWaterMeter = $waterMeter->update($waterMeterRequest);

            /** TODO - Update related record as well */

            DB::commit();

            return $newWaterMeter;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }
}
