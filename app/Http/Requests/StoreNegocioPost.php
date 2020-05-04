<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNegocioPost extends FormRequest
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
        return [
            'name' => 'required|max:100|unique:negocios',
            'owner_id' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'tipos' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4048'
        ];
    }

    public function attributes(){
        return [
            'name'=> 'nombre',
            'email' => 'correo',
            'address'=> 'dirección',
            'phone' => 'teléfono',
            'password' => 'contraseña',
            'owner_id' => "dueño del negocio",
            'tipos' => "tipo de negocio",
            'img' => "Imagen del negocio"
        ];
    }

    public function messages(){
        return [
            'name.required' => "El nombre del negocio es requerido",
            'name.unique' => 'Ya existe un registro de negocio con el mismo nombre, intente con otro',
            'phone.min' => "El teléfono debe tener 10 dígitos",
            'phone.max' => "El teléfono debe tener 10 dígitos",
            'email.required' => "El correo del negocio es requerido",
            'address.required' => "La dirección del negocio es requerido",
            'tipos.required' => "Seleccione al menos un tipo de negocio",
            'owner_id.required' => "El dueño del negocio es requerido, si no aparece el dueño debe de registralo",
            'img.required' => "Elija una foto o imagen del negocio",
            'img.image' => "El archivo tiene que ser una image, intente otra vez",
            'img.mimes' => 'Formato o tamaño inválido'
        ];
    }
}
