<?php

namespace App\Services;

use Storage;
use File;
use Dflydev\ApacheMimeTypes\PhpRepository;


class UploadService
{
    protected $disk;

    protected $phpRepository;

    public function __construct(PhpRepository $phpRepository)
    {
        $this->disk = Storage::disk(config('blog.uploads.storage'));
        $this->phpRepository = $phpRepository;
    }

    public function disk()
    {
        return $this->disk;
    }

    /**
     * 检查目录是否存在
     *
     * @param $path
     * @return bool
     */
    public function dirExists($path)
    {
        if ($path != "/") {
            return $this->disk->exists($path);
        }

        return true;
    }

    /**
     * 文件上传
     *
     * @param $request
     * @return array
     */
    public function uploadFile($request)
    {
        $dir = "/".trim(str_replace('\\', '/', $request->dir), '/')."/";
        if (!$this->dirExists($dir)) {
            return ['status' => false, 'msg' => '目录不存在'];
        }

        $file = $request->file('file');
        $name = $request->name;
        $fileName = $name != "" ? $name : md5(time().rand(0,10000));
        $saveFile = $dir.$fileName.'.'.$file->getClientOriginalExtension();

        if ($this->disk->exists($saveFile)) {
            return ['status' => false, 'msg' => '文件名以存在或文件以存在'];
        }

        if ($this->disk->put($saveFile, File::get($file->getPathname()))) {
            $url = route('backend.upload.index', ['dir' => $dir]);
            return ['status' => true, 'url' => $url];
        }
        return ['status' => false, 'msg' => '上传失败'];
    }

    /**
     * 获取目录下文件和文件列表
     *
     * @param $dir
     * @return array
     */
    public function folderInfo($dir)
    {
        $fileList = $this->fileInfo($dir);

        $dirList = $this->dirList($dir);

        return compact('fileList', 'dirList');
    }

    /**
     * 获取目录列表
     *
     * @param $dir
     * @return mixed
     */
    public function dirList($dir)
    {
        $list = $this->disk->directories($dir);
        $dirList = [];
        foreach ($list as $l) {
            $lArray = explode('/', str_replace('\\', '/', $l));
            $dirList[] = array_pop($lArray);
        }
        return $dirList;
    }

    /**
     * 文件信息
     *
     * @param $dir
     * @return array
     */
    public function fileInfo($dir)
    {
        $files = $this->disk->files($dir);

        $filesInfo = [];
        $webPath = config('blog.uploads.webPath');
        $host = url('/');
        if ($files) {
            foreach ($files as $file) {
                $temp = [];
                $temp['file_name']  = basename($file);
                $temp['mime_type']  = $this->getFileMimeType($file);
                $temp['size']       = $this->getFileSize($file);
                $temp['modified_date']   = $this->getLastModified($file);
                $temp['path']       = $host.$webPath."/".$file;

                $filesInfo[] = $temp;
            }
        }

        return $filesInfo;
    }

    public function getFileMimeType($path)
    {
        return $this->phpRepository->findType(pathinfo($path, PATHINFO_EXTENSION));
    }

    public function getFileSize($path)
    {
        return $this->disk->size($path);
    }

    public function getLastModified($path)
    {
        return date('Y-m-d H:i:s', $this->disk->lastModified($path));
    }
}