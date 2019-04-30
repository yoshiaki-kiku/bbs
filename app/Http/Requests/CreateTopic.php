<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTopic extends FormRequest
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
            'title' => 'required|max:50',
            'message' => 'required|max:1000',
            'post_image' => 'file|image|mimes:jpeg,png,jpg,gif|max:3000',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'message' => 'コメント',
            'post_image' => '添付画像',
        ];
    }
}
