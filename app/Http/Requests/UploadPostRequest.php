<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class UploadPostRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|alpha_dash|min:3|max:140'
            , 'g-recaptcha-response' => 'required|recaptcha'
        ];
    }
}
