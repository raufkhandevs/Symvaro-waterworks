<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MeterReading extends Model
{
    use HasFactory;

    protected $table = 'meter_readings';

    protected $fillable = [
        'water_meter_id',
        'source_id',
        'date',
        'reading',
    ];

    /**
     * Get all of the attachments for the MeterReading
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }

    /**
     * Get the waterMeter that owns the WaterMeter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function waterMeter(): BelongsTo
    {
        return $this->belongsTo(WaterMeter::class);
    }
}
