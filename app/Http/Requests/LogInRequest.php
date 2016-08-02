<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LogInRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //!\Auth::check(); //returns false if the user is already signed in
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'usrmail' => 'required|email',
            'usrpass' => 'required'
        ];
    }
}
