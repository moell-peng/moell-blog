<?php
/**
 * Created by PhpStorm.
 * User: moell
 * Date: 16-8-16
 * Time: 下午10:41
 */

namespace App\Services;


class ImageUploads
{
    protected  $file;

    public function uploadAvatar($file)
    {
        $this->file = $file;

        $allowedExtensions = ["png", "jpg", "jpeg", "gif"];

        $check = $this->check($allowedExtensions);
        if (!$check['status']) {
            return $check;
        }

        $destPath = public_path('uploads/avatar');

        $newFileName = md5(time().rand(0,10000)).'.'.$this->file->getClientOriginalExtension();
        if(!$this->file->move($destPath, $newFileName)){
            return ['status' => '系统异常，文件保存失败'];
        }

        return ['status' => true, 'fileName' => $newFileName];
    }

    private function check($allowedExtensions)
    {
        if (!$this->file->isValid()) {
            return ['status' => false, 'msg' => '文件上失败'];
        }

        if (!$this->checkAllowedExtensions($allowedExtensions)) {
            return ['status' => false, 'msg' => '非法的图片格式'];
        }

        if ($this->file->getSize() > 2 * 1024 * 1024) {
            return ['status' => false, 'msg' => '图片大小不能大于2M'];
        }

        return ['status' => true];
    }

    /**
     * 检测上传文件是否合法
     *
     * @param $allowedExtensions
     * @return bool
     */
    private function checkAllowedExtensions($allowedExtensions)
    {
        if (!in_array(strtolower($this->file->getClientOriginalExtension()), $allowedExtensions)) {
            return false;
        }
        return true;
    }
}