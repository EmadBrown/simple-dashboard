<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

        if ($this->route()->getName() == 'upload.profile.photo') {
            return
                ['image' => 'mimes:jpeg,jpg,png,gif|required'];
        } else {
            $userEmail =  User::find((int)$this->segments()[1])->email;
            return [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'phone' => ['required'],
                'location' => ['required'],
                'email' =>  ['required', 'string', 'email', $userEmail!= $this->email ? 'unique:users,email': null],

            ];
        }
    }
}
