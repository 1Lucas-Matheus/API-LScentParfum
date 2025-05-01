<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerfumeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $produtoId = $this->route('perfume');

        if ($this->isMethod('post')) {
            return [
                'name' => 'required|string|max:255|unique:products,name',
                'quantity' => 'required|integer|min:0',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
                'promo' => 'nullable|integer|min:0|max:100',
            ];
        }

        return [
            'name' => 'sometimes|required|string|max:255|unique:products,name,' . $produtoId,
            'quantity' => 'sometimes|required|integer|min:0',
            'price' => 'sometimes|required|numeric|min:0',
            'category_id' => 'sometimes|required|exists:categories,id',
            'promo' => 'nullable|integer|min:0|max:100',
        ];
    }
}
