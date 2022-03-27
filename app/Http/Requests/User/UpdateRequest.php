<?php

namespace App\Http\Requests\User;

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
            'name' => 'required',
            'last_name' => 'required',
            'telephone' => 'required|numeric|digits_between:6,10',
            'direction' => 'required',
            'date_of_birth' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->route('user')->id,
            'roles' => 'required'
        ];
    }
}
