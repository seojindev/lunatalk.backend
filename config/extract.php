<?php
return [
    'user' => [
        'user_level' => [
            'guest' => [
                'name' => '게스트',
                'level_code' => 'S020000'
            ],
            'user' => [
                'name' => '사용자',
                'level_code' => 'S020100'
            ],
            'admin' => [
                'name' => '관리자',
                'level_code' => 'S029000'
            ],
            'root' => [
                'name' => '최고 관리자',
                'level_code' => 'S029999'
            ],
        ],
        'user_state' => [
            'block' => [
                'name' => '차단',
                'code' => 'S020000'
            ],
            'deny' => [
                'name' => '제한',
                'code' => 'S020010'
            ],
            'waiting' => [
                'name' => '대기',
                'code' => 'S020011'
            ],
            'normal' => [
                'name' => '정상',
                'code' => 'S020100'
            ]
        ],
    ],
    'clientType' => [
        'front' => [
            'name' => '웹',
            'code' => 'S010010'
        ],
        'ios' => [
            'name' => 'iOS',
            'code' => 'S010020'
        ],
        'android' => [
            'name' => 'Android',
            'code' => 'S010030'
        ]
    ]
];
