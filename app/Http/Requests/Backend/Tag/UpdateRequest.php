<?php

namespace App\Http\Requests\Backend\Tag;

use App\Http\Requests\Request;

class UpdateRequest extends Request
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
        $id = $this->route('tag');
        return [
            'name' => 'required|unique:tags,tag_name,'.$id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '请填写分类名称',
            'name.unique'   => '标签名必须唯一'
        ];
    }
}
