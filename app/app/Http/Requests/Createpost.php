<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Createpost extends FormRequest
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
        //ポートフォリオ投稿時のバリデーション
        return [
            'date' => 'required|date',
            'comment' => 'required|max:500',
            'image' => 'required',
            'category' => 'required'
        ];
    }
}
