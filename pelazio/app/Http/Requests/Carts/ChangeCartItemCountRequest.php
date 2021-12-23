<?php

namespace App\Http\Requests\Carts;

use App\Models\CartItem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;

class ChangeCartItemCountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'cart_item_id' => ['required','integer',new Exists(CartItem::class,'id')],
            'quantity'     => ['required','integer']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
