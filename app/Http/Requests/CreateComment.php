<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateComment extends FormRequest
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
        // idは返信コメント時に返信コメントのidがあるか確認
        return [
            'message' => 'required|max:1000',
            'commnet_reply_id' => 'sometimes|required|exists:comments,id',
        ];
    }

    public function attributes()
    {
        return [
            'message' => 'コメント',
        ];
    }
}
