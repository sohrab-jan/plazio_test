<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'  => ['required','string','max:255'],
            'image' => ['required','image','mimes:jpg,png,jpeg,svg','max::2048'],
            'price' => ['required','integer'],
            'stock' => ['required','integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
