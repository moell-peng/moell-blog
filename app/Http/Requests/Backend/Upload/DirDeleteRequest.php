<?php

namespace App\Http\Requests\Backend\Upload;

use App\Http\Requests\Request;

class DirDeleteRequest extends Request
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
            'dir' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'dir.required' => '非法请求'
        ];
    }
}
