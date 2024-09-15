<?php   
return [
    'module' => [
        [
            'placeholderTitle' => 'Main',
            'title' => 'Dashboard',
            'icon' => 'link-icon',
            'route' => 'admin.dashboard',
            'data-feather' => 'box',
            'class' => 'nav-item',
            'name' => ['dashboard'],
        ],
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