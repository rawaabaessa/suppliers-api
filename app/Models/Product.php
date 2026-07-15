<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Farmer;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'farmer_id',
        'category_id',
        'price',
        'min_order',
        'image',
        'quantity',
    ];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
