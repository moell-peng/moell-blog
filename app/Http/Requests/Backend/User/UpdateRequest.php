<?php

namespace App\Http\Requests\Backend\User;

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
        $id = $this->route('user');
        return [
            'name' => "required|min:2",
            'email' => "required|email|unique:users,email,".$id,
            'password' => 'between:8,30'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '姓名必须填写',
            'name.min'      => '姓名最小不能小于两字符',
            'email.required'=> '登录邮箱必须填写',
            'email.unique'=> '登录邮箱必须唯一',
            'email.email'=> '请填写合法的邮箱',
            'password.between'=> '请填写8-30位的密码'
        ];
    }
}
