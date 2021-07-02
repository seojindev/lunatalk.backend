<?php

/**
 * 자주 사용하는 코드 정리.
 * 자주 사용하는 코드는 database select 안하고 설정 할수 있게.
 *
 * 다만 codes table 에 정보가 바뀌면 같이 바꿔 줘야 한다.
 */
return [
    'notification' => [
        'slack_webhook_url' => env('SLACK_WEBHOOK_URL'),
    ],
    'user' => [
        'user_level' => [
            'guest' => [
                'name' => '게스트',
                'level_code' => 'S020000'
            ],
            'user' => [
                'name' => '사용자',
                'level_code' => 'S020010'
            ],
            'admin' => [
                'name' => '관리자',
                'level_code' => 'S020900'
            ],
            'root' => [
                'name' => '최고 관리자',
                'level_code' => 'S029999'
            ],
        ],
        'user_state' => [
            'block' => [
                'name' => '차단',
                'code' => 'S030000'
            ],
            'deny' => [
                'name' => '제한',
                'code' => 'S030010'
            ],
            'waiting' => [
                'name' => '대기',
                'code' => 'S030011'
            ],
            'normal' => [
                'name' => '정상',
                'code' => 'S030100'
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
    ],

    'productCategory' => [
        'acc' => [
            'code' => 'P010110'
        ],
        'bag' => [
            'code' => 'P010120'
        ],
        'stationery' => [
            'code' => 'P010130'
        ],
        'wallet' => [
            'code' => 'P010140'
        ],
    ],

    'homeMainGubun' => [
        'mainTop' => [
            'name' => '메인 top',
            'code' => 'P100010'
        ],
        'mainBestItem' => [
            'name' => '메인 BEST ITEM',
            'code' => 'P100020'
        ],
        'mainHotItem' => [
            'name' => '메인 HOT ITEM',
            'code' => 'P100030'
        ],
    ],

    'prohibit' => [
        'login_id' => 'admin,administrator,webmaster,sysop,manager,root,su,guest',
        'nickname' => '관리자,운영자,어드민,주인장,웹마스터,시삽,시샵,매니저,메니저,루트,방문객,테스트,닉네임',
        'word' => '18아,18놈,18새끼,18뇬,18노,18것,18넘,개년,개놈,개뇬,개새,개색끼,개세끼,개세이,개쉐이,개쉑,개쉽,개시키,개자식,개좆,게색기,게색끼,광뇬,뇬,눈깔,뉘미럴,니귀미,니기미,니미,도촬,되질래,뒈져라,뒈진다,디져라,디진다,디질래,병쉰,병신,뻐큐,뻑큐,뽁큐,삐리넷,새꺄,쉬발,쉬밸,쉬팔,쉽알,스패킹,스팽,시벌,시부랄,시부럴,시부리,시불,시브랄,시팍,시팔,시펄,실밸,십8,십쌔,십창,싶알,쌉년,썅놈,쌔끼,쌩쑈,썅,써벌,썩을년,쎄꺄,쎄엑,쓰바,쓰발,쓰벌,쓰팔,씨8,씨댕,씨바,씨발,씨뱅,씨봉알,씨부랄,씨부럴,씨부렁,씨부리,씨불,씨브랄,씨빠,씨빨,씨뽀랄,씨팍,씨팔,씨펄,씹,아가리,아갈이,엄창,접년,잡놈,재랄,저주글,조까,조빠,조쟁이,조지냐,조진다,조질래,존나,존니,좀물,좁년,좃,좆,좇,쥐랄,쥐롤,쥬디,지랄,지럴,지롤,지미랄,쫍빱,凸,퍽큐,뻑큐,빠큐,ㅅㅂㄹㅁ',
    ]
];
