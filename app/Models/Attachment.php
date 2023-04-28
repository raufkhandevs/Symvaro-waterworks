<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    const ATTACHMENT_TYPES = [
        'document',
        'image',
        'video',
    ];

    protected $table = 'attachments';

    protected $fillable = [
        'meter_reading_id',
        'type',
        'name',
    ];
}
