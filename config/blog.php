<?php

return [
    'uploads' => [
        'storage' => 'upload',
        'webPath' => '/uploads'
    ],
    'menu' => [
        [
            'backend.home' => [
                'icon'  => 'fa fa-home',
                'name'  => 'Home'
            ]

        ],
        [
            'tree_title' => [
                'icon' => 'fa fa-files-o',
                'name' => '文章'
            ],
            'backend.article.index' => [
                'icon' => '',
                'name' => '文章管理'
            ],
            'backend.article.create' => [
                'icon' => '',
                'name' => '发布文章'
            ],
            'backend.category.index' => [
                'icon' => '',
                'name' => '文章分类'
            ]
        ],
        [
            'backend.tag.index' => [
                'icon' => 'fa fa-tags',
                'name' => '标签'
            ]
        ],
        [
            'backend.upload.index' => [
                'icon' => 'fa fa-file-image-o',
                'name' => '文件'
            ]
        ],
        [
            'backend.navigation.index' => [
                'icon' => 'fa fa-navicon',
                'name' => '导航'
            ]
        ],
        [
            'tree_title' => [
                'icon' => 'fa fa-user',
                'name' => '用户'
            ],
            'backend.user.index' => [
                'icon' => '',
                'name' => '用户管理'
            ],
            'backend.user.create' => [
                'icon' => '',
                'name' => '用户添加'
            ]
        ],
        [
            'tree_title' => [
                'icon' => 'fa fa-cog',
                'name' => '系统设置'
            ],
            'backend.system.index' => [
                'icon' => '',
                'name' => '系统设置'
            ],
            'backend.link.index' => [
                'icon' => '',
                'name' => '友情链接'
            ]
        ]
    ]
];