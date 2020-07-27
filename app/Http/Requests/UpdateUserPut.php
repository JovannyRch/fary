<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPut extends FormRequest
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
            'email' => 'required|email|max:255|unique:users,email,'.$this->route('user')->id,
            'address' => 'required|max:255',
            'phone' => 'required|min:10|max:10',
            'rol' => 'required'
        ];
    }
}
