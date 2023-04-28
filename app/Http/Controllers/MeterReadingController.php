<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeterReadingRequest;
use App\Http\Resources\MeterReadingResource;
use App\Models\MeterReading;
use App\Services\MeterReadingService;

class MeterReadingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meterReadings = MeterReading::with(['attachments', 'waterMeter.customer'])
            ->orderBy('id', 'desc')
            ->get();
        return MeterReadingResource::collection($meterReadings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMeterReadingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMeterReadingRequest $request, MeterReadingService $meterReadingService)
    {
        $meterReading = $meterReadingService->createBulkMeterReading($request->validated()['meter_readings']);

        if (!$meterReading) {
            return response()->json([
                'message' => 'An error occurred, please contact support@watermeter.co',
            ], 500);
        }

        return response()->json([
            'message' => ' created successfully',
            'waterMeter' => new MeterReadingResource($meterReading)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WaterMeter  $waterMeter
     * @return \Illuminate\Http\Response
     */
    public function show(MeterReading $meterReading)
    {
        return new MeterReadingResource($meterReading->load(['attachments', 'waterMeter.customer']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MeterReading  $meterReading
     * @return \Illuminate\Http\Response
     */
    public function destroy(MeterReading $meterReading)
    {
        if (empty($meterReading->attachments)) {
            $meterReading->delete;
            return response()->json(['message' => 'Record deleted'], 204);
        }
        return response()->json(['message' => "Can't delete record, found associated attachments"], 400);
    }
}
