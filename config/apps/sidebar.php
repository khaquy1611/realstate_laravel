<?php   
return [
    'module' => [
        [
            'placeholderTitle' => 'Main',
            'title' => 'Dashboard',
            'icon' => 'link-icon',
            'route' => 'dashboard',
            'data-feather' => 'box',
            'class' => 'nav-item',
            'name' => ['dashboard'],
        ],
        [
            'placeholderTitle' => 'Role',
            'title' => "Users Manager",
            'collapse' => 'user',
            'icon' => 'link-icon',
            'class' => 'nav-item',
            'data-feather' => 'user',
            'name' => ['user'],
            'subModule' => [
                [
                    'title' => 'User List',
                    'route' => 'user'
                ],
            ]
        ],
    ],
];