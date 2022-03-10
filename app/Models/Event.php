<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $fillable = [
        'active',
        'link',
        'user_id',
        'category_id',
        'name',
        'cover_path',
        'description',
        'date_event',
        'date_time',
        'location',
        'tags',
        'reviewed',
    ];

    use HasFactory;
}
