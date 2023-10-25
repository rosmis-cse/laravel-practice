<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'price' => 'required|string',
            'surface' => 'required|string',
            'rooms' => 'required|string',
            'options' => 'nullable|array',
        ];
    }
}
