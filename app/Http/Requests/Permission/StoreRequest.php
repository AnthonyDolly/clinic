<?php

namespace App\Http\Requests\Permission;

use App\Models\Permission;
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
        return $this->user()->can('create', Permission::class);
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
            'description' => 'required',
            'role_id' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo de nombre es requerido',
            'name.unique' => 'El nombre ya está ocupado',
            'description.required' => 'La descripción es requerida',
            'role_id.required' => 'El campo de rol es requerido',
            'role_id.numeric' => 'El formato no es correcto'
        ];
    }
}
