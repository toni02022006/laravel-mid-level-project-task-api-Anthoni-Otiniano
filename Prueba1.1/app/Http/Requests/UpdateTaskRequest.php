<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // Importar la clase Rule
use App\Models\Project; // Importar el modelo Project

class UpdateTaskRequest extends FormRequest
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
            'project_id' => [
                'required',
                'uuid',
                Rule::exists('projects', 'id'), // Valida que el project_id exista
            ],
            'title' => 'required|string|min:3|max:100',
            'description' => 'nullable|string',
            'status' => [
                'required',
                'string',
                Rule::in(['pending', 'in_progress', 'done']),
            ],
            'priority' => [
                'required',
                'string',
                Rule::in(['low', 'medium', 'high']),
            ],
            'due_date' => 'required|date|after_or_equal:today', // La fecha de vencimiento no puede ser pasada
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
            'project_id.required' => 'El ID del proyecto es obligatorio.',
            'project_id.uuid' => 'El ID del proyecto debe ser un UUID válido.',
            'project_id.exists' => 'El proyecto especificado no existe.',
            'title.required' => 'El título de la tarea es obligatorio.',
            'title.string' => 'El título de la tarea debe ser una cadena de texto.',
            'title.min' => 'El título de la tarea debe tener al menos :min caracteres.',
            'title.max' => 'El título de la tarea no puede exceder los :max caracteres.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'status.required' => 'El estado de la tarea es obligatorio.',
            'status.string' => 'El estado de la tarea debe ser una cadena de texto.',
            'status.in' => 'El estado de la tarea debe ser "pending", "in_progress" o "done".',
            'priority.required' => 'La prioridad de la tarea es obligatoria.',
            'priority.string' => 'La prioridad de la tarea debe ser una cadena de texto.',
            'priority.in' => 'La prioridad de la tarea debe ser "low", "medium" o "high".',
            'due_date.required' => 'La fecha de vencimiento es obligatoria.',
            'due_date.date' => 'La fecha de vencimiento debe ser una fecha válida.',
            'due_date.after_or_equal' => 'La fecha de vencimiento no puede ser una fecha pasada.',
        ];
    }
}