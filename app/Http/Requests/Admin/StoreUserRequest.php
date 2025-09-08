<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:70',
            'last_name' => 'string|max:70',
            'document_number' => 'required|integer|unique:users,document_number',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:30|unique:users,username',
        ];
    }

    public function messages() {

        return [
            'first_name.required' => 'El nombre es obligatorio.',
            'first_name.string' => 'El nombre debe ser un texto.',
            'first_name.max' => 'El nombre no puede tener más de 70 caracteres.',

            'last_name.string' => 'El apellido debe ser un texto.',
            'last_name.max' => 'El apellido no puede tener más de 70 caracteres.',

            'document_number.required' => 'El documento de identidad es obligatorio.',
            'document_number.integer' => 'El documento de identidad debe contener solo números.',
            'document_number.unique' => 'El documento de identidad ya está registrado.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico es inválido.',
            'email.unique' => 'El correo electrónico ya está registrado.',

            'username.required' => 'El usuario es obligatorio.',
            'username.string' => 'El usuario debe ser un texto.',
            'username.max' => 'El usuario no puede tener más de 30 caracteres.',
            'username.unique' => 'El usuario ya está registrado.',
        ];
    }
}
