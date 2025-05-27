<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // Importar la clase Rule

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Por ahora, permitimos que cualquiera haga la solicitud
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:100',
                Rule::unique('projects', 'name'), // Asegura que el nombre sea único en la tabla 'projects'
            ],
            'description' => 'nullable|string',
            'status' => [
                'required',
                'string',
                Rule::in(['active', 'inactive']), // Valida que el status sea 'active' o 'inactive'
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del proyecto es obligatorio.',
            'name.string' => 'El nombre del proyecto debe ser una cadena de texto.',
            'name.min' => 'El nombre del proyecto debe tener al menos :min caracteres.',
            'name.max' => 'El nombre del proyecto no puede exceder los :max caracteres.',
            'name.unique' => 'Ya existe un proyecto con este nombre.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'status.required' => 'El estado del proyecto es obligatorio.',
            'status.string' => 'El estado del proyecto debe ser una cadena de texto.',
            'status.in' => 'El estado del proyecto debe ser "active" o "inactive".',
        ];
    }
}