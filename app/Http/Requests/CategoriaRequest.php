<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categoriaId = $this->route('categoria');

        if ($this->isMethod('post')) {
            return [
                'name' => 'required|string|max:255|unique:categories,name',
            ];
        }

        return [
            'name' => 'sometimes|required|string|max:255|unique:categories,name,' . $categoriaId,
        ];
    }
}
