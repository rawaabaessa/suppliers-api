<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrdersItem;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'farmer_id',
        'delivery_slot_id',
        'total_price',
        'status',
        'order_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }

    public function items()
    {
        return $this->hasMany(OrdersItem::class);
    }
}
