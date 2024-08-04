<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookParking extends Model {
    use HasFactory;
    protected $table = 'bookparking';

    protected $fillable = [
        'id',
        'uuid',
        'carplate',
        'Start Time',
        'End Time',
    ];
}