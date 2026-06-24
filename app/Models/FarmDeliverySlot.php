<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmDeliverySlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmer_id',
        'delivery_slot_id',
    ];
}
