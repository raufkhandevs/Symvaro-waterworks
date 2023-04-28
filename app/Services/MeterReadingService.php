<?php

namespace App\Services;

use App\Models\Attachment;
use App\Models\MeterReading;
use App\Models\WaterMeter;

class MeterReadingService
{
    public function createMeterReading($meterReading)
    {
        $newMeterReading = MeterReading::create($meterReading);

        /** if has many attachments to it */
        if (array_key_exists('attachments', $meterReading) && $meterReading['attachments']) {
            $this->createBulkAttachments($meterReading['attachments'], $meterReading);
        }

        return $newMeterReading;
    }

    public function createBulkMeterReading($meterReadings, WaterMeter $waterMeter = null)
    {
        $data = [];
        foreach ($meterReadings as $meterReading) {
            /** if current object does not have key associate it to parent record */
            if (!array_key_exists("water_meter_id", $meterReading)) {
                $meterReading['water_meter_id'] = $waterMeter ? $waterMeter->id : null;
            }
            $data[] = $this->createMeterReading($meterReading);
        }

        return $data;
    }

    public function createBulkAttachments($attachments, MeterReading $meterReading)
    {
        foreach ($attachments as $attachment) {
            /** if current object does not have key associate it to parent record */
            if (!array_key_exists("meter_reading_id", $attachment)) {
                $meterReading['meter_reading_id'] = $meterReading->id;
            }
            $this->createAttachment($meterReading);
        }
    }

    public function createAttachment($attachment)
    {
        $file = $attachment['file'];
        $fileName =  time() . $file->getClientOriginalExtension();

        $file->move(public_path() . '/files/', $fileName);

        /** replace file with fileName, to store into the database */
        $attachment['file'] = $fileName;

        Attachment::create($attachment);
    }
}
