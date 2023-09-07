<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnakRequest extends FormRequest
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
        $id = (isset($this->anak) ? $this->anak->user->id : '');

        if($id) {
            $min_password = '';
        } else {
            $min_password = 'min:8';
        }

        return [
            'username' => 'min:5|unique:users,username,'.$id,
            'password' => $min_password.'|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'username.min' => 'Username minimal :min karakter',
            'username.unique' => 'Username sudah digunakan',
            'password.min' => 'Password minimal :min karakter',
            'password.confirmed' => 'Password tidak sama'
        ];
    }
}
