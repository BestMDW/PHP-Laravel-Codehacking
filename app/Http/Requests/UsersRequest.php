<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Auth\User;

class UsersRequest extends Request
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

    /******************************************************************************************************************/

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = User::find($this->users);

        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];

            case 'POST':
                return [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
                    'role_id' => 'required',
                    'is_active' => 'required'
                ];

            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                    'password' => 'min:6|confirmed',
                    'role_id' => 'required',
                    'is_active' => 'required'
                ];
        }
    }
}
