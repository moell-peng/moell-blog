<?php

namespace App\Http\Requests\Backend\Upload;

use App\Http\Requests\Request;

class FileDeleteRequest extends Request
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
            'file' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'file.required' => '非法请求'
        ];
    }
}
