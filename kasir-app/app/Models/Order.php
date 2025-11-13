<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice',
        'user_id',
        'total',
        'paid',
        'change',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
