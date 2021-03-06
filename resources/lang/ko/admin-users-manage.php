<?php

return [
    /*
    |--------------------------------------------------------------------------
    | For Admin Site Manage
    |--------------------------------------------------------------------------
    */

    'update' =>[
        'uuid' => [
            'required' => '사용자 정보가 존재 하지 않습니다.',
            'exists' => '존재 하지 않은 사용자 입니다.',
        ],
        'type' => [
            'required' => '사용자 타입을 선택해 주세요.',
            'exists' => '존재 하는 타입이 아닙니다.',
        ],
        'level' => [
            'required' => '사용자 레벨을 선택해 주세요.',
            'exists' => '존재 하는 레벨 코드가 아닙니다.',
        ],
        'status' => [
            'required' => '사용자 상태를 선택해 주세요.',
            'exists' => '존재 하는 상태 코드가 아닙니다.',
        ],
        'user_name' => [
            'required' => '상태를 선택해 주세요.',
        ],
        'email' => [
            'required' => '정확한 이메일을 입력해 주세요.',
            'check' => '정확한 이메일을 입력해 주세요.',
            'unique' => '이미 사용중인 이메일 주소 입니다.',
        ],
        'select_email' => [
            'required' => '마케팅 알림 메일 수신 동의를 선택 또는 해제해 주세요.',
            'in' => '마케팅 알림 메일 수신 동의에 대한 정확한 데이터가 아닙니다.',
        ],
        'select_message' => [
            'required' => '맞춤 혜택 알림 문자 수신 동의를 선택 또는 해제해 주세요.',
            'in' => '맞춤 혜택 알림 문자 수신 동의에 대한 정확한 선택 데이터가 아닙니다.',
        ],
    ],
    'create' => [
        'type' => [
            'required' => '사용자 타입을 선택해 주세요.',
            'exists' => '존재 하는 타입이 아닙니다.',
        ],
        'level' => [
            'required' => '사용자 레벨을 선택해 주세요.',
            'exists' => '존재 하는 레벨 코드가 아닙니다.',
        ],
        'status' => [
            'required' => '사용자 상태를 선택해 주세요.',
            'exists' => '존재 하는 상태 코드가 아닙니다.',
        ],
        'user_id' => [
            'reqquired' => '로그인 아이디를 입력해 주세요.',
            'check' => '정확한 아이디를 입력해 주세요. (길이 : 5~20자, 첫글자 숫자 사용 불가, 특수 기호 사용 불가)',
            'unique' => '이미 사용중인 아이디 입니다.',
        ],
        'user_password' => [
            'required' => '비밀 번호를 입력해 주세요.',
            'check' => '정확한 패스워드를 입력해 주세요. (길이 : 5~20자)',
        ],

        'user_phone_number' => [
            'required' => '휴대폰 번호를 입력해 주세요.',
            'minmax' => '휴대폰 번호의 자리수를 확인해 주세요.',
            'numeric' => '휴대폰 번호는 숫자로만 입력해 주세요.',
        ],


        'user_name' => [
            'required' => '상태를 선택해 주세요.',
        ],
        'email' => [
            'required' => '정확한 이메일을 입력해 주세요.',
            'check' => '정확한 이메일을 입력해 주세요.',
            'unique' => '이미 사용중인 이메일 주소 입니다.',
        ],
        'select_email' => [
            'required' => '마케팅 알림 메일 수신 동의를 선택 또는 해제해 주세요.',
            'unique' => '이미 사용중인 이메일 입니다.',
        ],
        'select_message' => [
            'required' => '맞춤 혜택 알림 문자 수신 동의를 선택 또는 해제해 주세요.',
            'in' => '맞춤 혜택 알림 문자 수신 동의에 대한 정확한 선택 데이터가 아닙니다.',
        ],
    ],
    'update_password' => [
        'uuid' => [
            'exists' => '존재 하는 사용자가 아닙니다.'
        ],
        'user_password' => [
            'required' => '비밀 번호를 입력해 주세요.',
            'check' => '정확한 패스워드를 입력해 주세요. (길이 : 5~20자)',
        ],
    ],
    'update_phone_number' => [
        'uuid' => [
            'exists' => '존재 하는 사용자가 아닙니다.'
        ],
        'user_phone_number' => [
            'required' => '휴대폰 번호를 입력해 주세요.',
            'minmax' => '휴대폰 번호의 자리수를 확인해 주세요.',
            'numeric' => '휴대폰 번호는 숫자로만 입력해 주세요.',
        ],
    ],
];
