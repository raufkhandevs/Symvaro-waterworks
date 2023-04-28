<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWaterMeterRequest;
use App\Http\Requests\UpdateWaterMeterRequest;
use App\Http\Resources\WaterMeterResource;
use App\Models\WaterMeter;
use App\Services\MeterReadingService;
use App\Services\WaterMeterService;

class WaterMeterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $waterMeters = WaterMeter::with(['customer', 'meterReadings.attachments'])
            ->orderBy('id', 'desc')
            ->get();
        return WaterMeterResource::collection($waterMeters);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWaterMeterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWaterMeterRequest $request, WaterMeterService $waterMeterService, MeterReadingService $meterReadingService)
    {
        $waterMeter = $waterMeterService->createWaterMeter($request, $meterReadingService);

        if (!$waterMeter) {
            return response()->json([
                'message' => 'An error occurred, please contact support@watermeter.co',
            ], 500);
        }

        return response()->json([
            'message' => 'Bulk entry created successfully',
            'waterMeter' => new WaterMeterResource($waterMeter->load(['customer', 'meterReadings.attachments']))
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WaterMeter  $waterMeter
     * @return \Illuminate\Http\Response
     */
    public function show(WaterMeter $waterMeter)
    {
        return new WaterMeterResource($waterMeter->load(['customer', 'meterReadings.attachments']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWaterMeterRequest  $request
     * @param  \App\Models\WaterMeter  $WaterMeter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWaterMeterRequest $request, WaterMeter $waterMeter, WaterMeterService $waterMeterService, MeterReadingService $meterReadingService)
    {
        $updatedWaterMeter = $waterMeterService->updateWaterMeter($request, $waterMeter, $meterReadingService);

        if (!$updatedWaterMeter) {
            return response()->json([
                'message' => 'An error occurred, please contact support@watermeter.co',
            ], 500);
        }

        return response()->json([
            'message' => 'Bulk entry updated successfully',
            'waterMeter' => new WaterMeterResource($waterMeter->load(['customer', 'meterReadings.attachments']))
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WaterMeter  $waterMeter
     * @return \Illuminate\Http\Response
     */
    public function destroy(WaterMeter $waterMeter)
    {
        if (empty($waterMeter->meterReadings)) {
            $waterMeter->delete;
            return response()->json(['message' => 'Record deleted'], 204);
        }
        return response()->json(['message' => "Can't delete record, found associated readings"], 400);
    }
}
