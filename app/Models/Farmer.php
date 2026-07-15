<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;


#[Fillable(['user_id', 'farm_name', 'phone','identity_number','license','city','neighborhood','street'])]

class Farmer extends Model
{
    protected $fillable = [
        'user_id',
        'farm_name',
        'phone',
        'identity_number',
        'license',
        'city',
        'neighborhood',
        'street',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function bankInfo()
    {
        return $this->hasOne(BankInfo::class);
    }
}
