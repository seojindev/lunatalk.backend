<?php
return [
    'user' => [
        'user_level' => [
            'guest' => [
                'name' => '게스트',
                'level_code' => 'S02000'
            ],
            'user' => [
                'name' => '사용자',
                'level_code' => 'S02010'
            ],
            'admin' => [
                'name' => '관리자',
                'level_code' => 'S02900'
            ],
            'root' => [
                'name' => '최고 관리자',
                'level_code' => 'S02999'
            ],
        ],
    ],
    'clientType' => [
        'front' => [
            'name' => '웹',
            'code' => 'S01010'
        ],
        'ios' => [
            'name' => 'iOS',
            'code' => 'S01020'
        ],
        'android' => [
            'name' => 'Android',
            'code' => 'S01030'
        ]
    ]
];
