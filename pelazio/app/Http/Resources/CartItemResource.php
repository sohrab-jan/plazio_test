<?php

namespace App\Http\Resources;

use App\Models\CartItem;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

/** @mixin CartItem */
class CartItemResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'product'    => new ProductResource($this->whenLoaded('product')),
            'cart_id'    => $this->cart_id,
            'quantity'   => $this->quantity,
            'item_cost' => $this->item_cost
        ];
    }
}
