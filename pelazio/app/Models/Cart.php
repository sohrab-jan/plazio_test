<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'status'
    ];

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function getTotalCostAttribute()
    {
        return $this->cartItems->sum('item_cost');
    }

}
