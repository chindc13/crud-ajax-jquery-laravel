<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calls extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 
        'call_date', 
        'duration',
        'dialed_phone',
        'customer_ip',
    ];
}
