<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSource extends Model
{
    use HasFactory;

    protected $table = 'system_sources';

    protected $fillable = [
        'name',
        'source_ip',
    ];
}
