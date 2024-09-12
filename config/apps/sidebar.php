<?php   
return [
    'module' => [
        [
            'title' => 'Article',
            'icon' => 'link-icon',
            'class' => 'nav-item',
            'name' => ['email'],
            'subModule' => [
                [
                    'title' => 'Inbox',
                    'route' => '/'
                ],
                [
                    'title' => 'Read',
                    'route' => '/'
                ]
            ]
        ],
    ],
];