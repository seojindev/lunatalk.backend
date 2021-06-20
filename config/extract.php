<?php

/**
 * 자주 사용하는 코드 정리.
 * 자주 사용하는 코드는 database select 안하고 설정 할수 있게.
 *
 * 다만 codes table 에 정보가 바뀌면 같이 바꿔 줘야 한다.
 */
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
        ],
        'service_front' => [
            'name' => 'Service-Front',
            'code' => 'S010040'
        ]
    ],
    'mediaCategory' => [
        'repImage' => [
            'name' => '상품이미지',
            'code' => 'G010010'
        ],
        'detailImage' => [
            'name' => '상품 상세 이미지',
            'code' => 'G010020'
        ]
    ]

];
