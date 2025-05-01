<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LembreteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'reminder' => 'required|string|max:255',
                'date' => 'required|date|after_or_equal:today',
            ];
        }

        return [
            'reminder' => 'sometimes|required|string|max:255',
            'date' => 'sometimes|required|date|after_or_equal:today',
        ];
    }
}

