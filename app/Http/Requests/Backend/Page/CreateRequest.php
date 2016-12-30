<?php

namespace App\Http\Requests\Backend\Page;

use App\Http\Requests\Request;

class CreateRequest extends Request
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
            'title' => 'required',
            'link_alias' => 'unique:pages'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '页面标题必须填写',
            'link_alias.unique' => '链接别名必须唯一'
        ];
    }
}
