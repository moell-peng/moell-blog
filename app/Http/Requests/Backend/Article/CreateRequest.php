<?php

namespace App\Http\Requests\Backend\Article;

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
            'cate_id'   => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'title.required'    => '请输入文章标题',
            'cate_id.required'  => '请选择文章分类',
            'cate_id.numeric'   => '请选择合法的分类'
        ];
    }
}
