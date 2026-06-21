<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TareaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'completada' => 'nullable|boolean',
            'vence_el' => 'nullable|date',
        ];
    }
}