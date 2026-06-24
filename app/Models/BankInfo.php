<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmer_id',
        'bank_name',
        'account_holder_name',
        'iban',
    ];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }
}
