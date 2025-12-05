<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image'    => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'category' => 'required|exists:categories,id',
        ];
    }
}
