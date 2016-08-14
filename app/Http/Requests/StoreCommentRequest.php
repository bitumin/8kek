<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreCommentRequest extends Request
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
            'post_id' => 'required|integer|exists:posts,id',
            'user_id' => 'sometimes|required|integer|exists:users,id',
            'content' => 'required|string|alpha_dash|min:1|max:200',
            'g-recaptcha-response' => 'required|recaptcha'
        ];
    }
}
