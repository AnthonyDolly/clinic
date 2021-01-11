<?php

namespace App\Http\Requests\Specialty;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $specialty = $this->route('specialty');
        return $this->user()->can('update', $specialty);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:specialties,name, ' . $this->route('specialty')->id . '|max:255'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.unique' => 'La especialidad ya existe'
        ];
    }
}
