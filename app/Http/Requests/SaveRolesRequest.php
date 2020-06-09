<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveRolesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // dd($this->request);
        // dd($this->method());
        
        $rules = [
            'display_name' => 'required'
        ];

        if($this->method() === 'POST')
        {
            $rules['name'] = 'required|unique:roles';
        }
        
       
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'El Identificador es obligatorio.',
            'name.unique' => 'El Identificador ya se encuentra registrado.',
            'display_name.required' => 'El Nombre es obligatorio.',
        ];
    }
}
