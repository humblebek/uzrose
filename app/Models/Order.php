<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    public $guarded = [];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

}
