<?php

namespace App\Http\Requests;

use App\Models\Attachment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMeterReadingRequest extends FormRequest
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
            'meter_readings' => 'required|array',
            // validate array data 
            'meter_readings.*.water_meter_id' => 'required|exists:water_meters,id',
            'meter_readings.*.source_id' => 'required|exists:system_sources,id',
            'meter_readings.*.date' => 'required|date_format:Y-m-d H:i:s',
            'meter_readings.*.reading' => 'required|numeric',

            'attachments' => 'nullable|array',
            // validate array data if attachments available
            'attachments.*.type' => ['required_with:meter_readings', 'required', Rule::in(Attachment::ATTACHMENT_TYPES)],
            'attachments.*.file' => 'required_with:meter_readings|file|mimes:jpg,png,jpeg,pdf,mp4',
        ];
    }
}
