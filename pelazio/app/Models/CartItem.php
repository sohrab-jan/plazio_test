<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $fillable = [
        'product_id',
        'cart_id',
        'quantity'
    ];

    protected $appends = [
        'total_cost'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getItemCostAttribute()
    {
        return $this->quantity * $this->product->price;
    }

}
