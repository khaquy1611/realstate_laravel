<?php   
return [
    'module' => [
        [
            'title' => "Quản lí người dùng",
            'collapse' => 'user',
            'icon' => 'link-icon',
            'class' => 'nav-item',
            'data-feather' => 'user',
            'name' => ['users'],
            'subModule' => [
                [
                    'title' => 'Danh sách người dùng',
                    'route' => 'admin.users.index'
                ],
            ]
        ],
        [
            'title' => "Quản lí Email",
            'collapse' => 'email',
            'icon' => 'link-icon',
            'class' => 'nav-item',
            'data-feather' => 'mail',
            'name' => ['email'],
            'subModule' => [
                [
                    'title' => 'Soạn Email',
                    'route' => 'admin.email.compose'
                ],
                [
                    'title' => 'Thư đã gửi',
                    'route' => 'admin.email.send'
                ],
            ]
        ],
    ],
];