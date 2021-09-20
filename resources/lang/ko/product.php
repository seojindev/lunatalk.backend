<?php

return [
    /*
    |--------------------------------------------------------------------------
    | For Product Message
    |--------------------------------------------------------------------------
    */

    'admin' => [
        'category' =>[
            'create' => [
                'name' => [
                    'required' => '제목을 입력해 주세요.',
                    'unique' => '이미 사용중인 카테고리명 입니다.'
                ]
            ],
            'update' => [
                'uuid' => [
                    'required' => 'uuid 정보가 존재 하지 않습니다.',
                    'exits' => '존재하는 카테고리정보가 아닙니다.',
                ],
                'name' => [
                    'required' => '제목을 입력해 주세요.',
                ]
            ],
            'delete' => [
                'uuid' => [
                    'required' => 'uuid 정보가 존재 하지 않습니다.',
                    'exits' => '존재하는 카테고리정보가 아닙니다.',
                ],
                'name' => [
                    'required' => '제목을 입력해 주세요.',
                ]
            ],
        ],
        'product' =>[
            'service' => [
                'name' => [
                    'required' => '상품명을 입력해 주세요.',
                ],
                'category' => [
                    'required' => '카테고리를 선택해 주세요.',
                    'exists' => '존재 하지 않는 카테고리 정보입니다.',
                ],
                'color' => [
                    'required' => '카테고리를 선택해 주세요.',
                    'exists' => '존재 하지 않는 옵션(색) 정보입니다.',
                ],
                'wireless' => [
                    'required' => '카테고리를 선택해 주세요.',
                ],
                'price' => [
                    'required' => '금액을 입력해 주세요.',
                ],
                'quantity' => [
                    'required' => '수량을 입력해 주세요.',
                ],
                'sale' => [
                    'required' => '판매 상태를 선택해 주세요.',
                    'in' => '정확한 판매 상태를 선택해 주세요.',
                ],
                'active' => [
                    'required' => '상품 상태를 선택해 주세요.',
                    'in' => '정확한 상품 상태를 선택해 주세요.',
                ],
                'rep_image' => [
                    'required' => '대표 이미지를 선택해 주세요.',
                    'integer' => '정확한 대표 이미지를 선택해 주세요.',
                    'exists' => '존재 않은 대표 이미지를 입니다.',
                ],
                'detail_image' => [
                    'required' => '상품 상세 이미지를 선택해 주세요.',
                    'integer' => '정확한 상세 이미지를 선택해 주세요.',
                    'exists' => '존재 않은 상세 이미지를 입니다.',
                ],
                'uuid' => [
                    'required' => 'uuid 정보가 존재하지 않습니다.',
                    'array' => 'uuid 정보가 존재하지 않습니다.',
                    'exists' => '존재 하지 않은 상품 입니다.',
                ]

            ],
        ]
    ],
];
