<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserPost extends FormRequest
{
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
        return [
            'name' => 'required|max:50',
            'email' => 'required|email|max:255|unique:users',
            'address' => 'required|max:255',
            'phone' => 'required|min:10|max:10',
            'password' => 'required|min:3:string',
            'rol' => 'required'
        ];
    }

    public function attributes(){
        return [
            'name'=> 'nombre',
            'email' => 'correo',
            'address'=> 'dirección',
            'phone' => 'teléfono',
            'password' => 'contraseña'
        ];
    }

    public function messages(){
        return [
            'name.required' => "El nombre de usuario es requerido",
            'phone.min' => "El teléfono debe tener 10 dígitos",
            'phone.max' => "El teléfono debe tener 10 dígitos",
            'password.min' => "La contraseña debe tener al menos 10 dígitos",
            'rol.required' => "El tipo de usuario es requerido"
        ];
    }
}
