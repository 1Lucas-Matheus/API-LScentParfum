<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CupomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $cupomId = $this->route('cupom');

        if ($this->isMethod('post')) {
            return [
                'key' => 'required|string|max:12|unique:coupons,key',
                'value' => 'required|integer|unique:coupons,value',
            ];
        }

        return [
            'key' => 'sometimes|required|string|max:12|unique:coupons,key,' . $cupomId,
            'value' => 'sometimes|required|integer|unique:coupons,value,' . $cupomId,
        ];
    }
}
