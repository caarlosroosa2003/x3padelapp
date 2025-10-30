<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            // Email no es editable, se elimina de las reglas de validación
            'telefono' => ['nullable', 'string', 'max:20'],
        ];
    }
    
    /**
     * Preparar los datos para validación.
     * Elimina el email si se intenta enviar.
     */
    protected function prepareForValidation(): void
    {
        // Eliminar el email de la solicitud para asegurar que no se actualice
        $this->request->remove('email');
    }
}
