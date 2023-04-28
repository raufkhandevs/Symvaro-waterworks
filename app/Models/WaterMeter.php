<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WaterMeter extends Model
{
    use HasFactory;

    protected $table = 'water_meters';

    protected $fillable = [
        'meter_number',
        'customer_id',
        'location',
    ];

    /**
     * Get the customer that owns the WaterMeter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get all of the meterReadings for the WaterMeter
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function meterReadings(): HasMany
    {
        return $this->hasMany(MeterReading::class);
    }
}
