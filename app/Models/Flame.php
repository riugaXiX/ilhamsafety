<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flame extends Model
{
    use HasFactory;

    protected $table = 'flames';

    protected $fillable = [
        'api'
    ];
}
