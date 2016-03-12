<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CodeliveRequest extends Request
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
    public function rules() {
        return ['title' => 'required|min:1|max:250', ];
    }
    public function messages() {
        return ['title.required' => 'タイトルは3文字-250文字の範囲で入力してください',  ];
    }

}
