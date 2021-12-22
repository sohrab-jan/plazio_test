<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

/** @mixin Product */
class ProductResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'image'      => $this->image,
            'price'      => $this->price,
            'stock'      => $this->stock,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
