<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Cambia esto si necesitas una lógica de autorización
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        // Reglas base
        $rules = [
            'nombre_completo' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'password' => 'nullable|string|min:8|confirmed', // Si se proporciona, debe ser mínimo 8 caracteres y confirmarse
        ];

        // Añadir regla para 'nombre_anonimo' solo si el usuario es una usuaria
        if ($this->user()->rol == 'usuaria') {
            $rules['nombre_anonimo'] = 'nullable|string|max:255';
        }

        return $rules;
    }
}
