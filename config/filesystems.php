<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],

        'qiniu' => [
            'driver'     => 'qiniu',
            'domains' => [
                'default'   => env('QINIU_DOMAIN'), //你的七牛域名
                'https'     => env('QINIU_DOMAIN_HTTPS', ''),         //你的HTTPS域名
                'custom'    => env('QINIU_CUSTOM', 'static.abc.com'),                //Useless 没啥用，请直接使用上面的 default 项
            ],
            'access_key' => env('QINIU_ACCESS_KEY'),
            'secret_key' => env('QINIU_SECRET_KEY'),
            'bucket'     => env('QINIU_BUCKET'),
            'notify_url'=> env('QINIU_NOTIFY_URL', ''),  //持久化处理回调地址
            'access'    => 'public',  //空间访问控制 public 或 private
            'hotlink_prevention_key' => env('QINIU_HOTLINK_KEY', 'afc89ff8bd2axxxxxxxxxxxxxxbb'), // CDN 时间戳防盗链的 key。 设置为 null 则不启用本功能。
        ],
    ],

];
