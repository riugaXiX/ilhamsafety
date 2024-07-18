<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dht extends Model
{
    use HasFactory;

    protected $table = 'dhts';

    protected $fillable = [
        'suhu',
        'kelembapan'
    ];
}
