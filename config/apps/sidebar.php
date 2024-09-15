<?php   
return [
    'module' => [
        [
            'placeholderTitle' => 'Role',
            'title' => "Quản lí người dùng",
            'collapse' => 'user',
            'icon' => 'link-icon',
            'class' => 'nav-item',
            'data-feather' => 'user',
            'name' => ['user'],
            'subModule' => [
                [
                    'title' => 'Danh sách người dùng',
                    'route' => 'admin.users.index'
                ],
            ]
        ],
    ],
];