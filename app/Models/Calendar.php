<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $fillable = [
        'active',
        'name',
        'cover_path',
        'description',
        'date_event',
        'date_time',
        'location',
    ];

    use HasFactory;
}
