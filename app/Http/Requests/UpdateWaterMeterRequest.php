<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWaterMeterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'location' => 'required',
            'meter_number' => "required|unique:water_meters,meter_number,{$this->waterMeter->id}",

            'meter_readings' => 'nullable|array',
            // validate array data if meter_reading available
            'meter_readings.*.source_id' => 'required_with:meter_readings|exists:system_sources,id',
            'meter_readings.*.date' => 'required_with:meter_readings|date_format:Y-m-d H:i:s',
            'meter_readings.*.reading' => 'required_with:meter_readings|numeric',
        ];
    }
}
