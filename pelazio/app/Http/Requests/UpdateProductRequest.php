<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'  => ['required','string','max:255'],
            'image' => ['nullable','image','mimes:jpg,png,jpeg,svg','max:2048'],
            'price' => ['nullable','integer'],
            'stock' => ['nullable','integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
