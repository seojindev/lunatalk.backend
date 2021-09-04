<?php

return [
    /*
    |--------------------------------------------------------------------------
    | For Product Message
    |--------------------------------------------------------------------------
    */

    'admin' => [
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
    ],
];
