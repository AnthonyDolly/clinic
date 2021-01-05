<?php

namespace App\Http\Requests\Role;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Role::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:roles|max:255',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre del rol es requerido',
            'name.unique' => 'El nombre ya está ocupado',
            'description.required' => 'La descripción es requerida'
        ];
    }
}
