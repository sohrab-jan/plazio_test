<?php

namespace App\Http\Requests\Carts;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;

class AddToCartRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_id' => ['required','integer',new Exists(Product::class,'id')],
            'quantity'   => ['required','integer']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
