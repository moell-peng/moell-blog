<?php

namespace App\Http\Requests\Backend\Upload;

use App\Http\Requests\Request;

class UploadStoreRequest extends Request
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
            'dir'   => 'required',
            'file'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'dir.required'  => '保存目录不能为空',
            'file.required' => '请选择上传的文件'
        ];
    }
}
