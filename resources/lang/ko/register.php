<?php

return [
    /*
    |--------------------------------------------------------------------------
    | For Register Message
    |--------------------------------------------------------------------------
    */

    'register_success' => '회원 가입이 완료 되었습니다.',
    'phone_auth' => [
        'required' => '휴대폰 번호를 입력해 주세요.',
        'minmax' => '휴대폰 번호의 자리수를 확인해 주세요.',
        'numeric' => '휴대폰 번호는 숫자로만 입력해 주세요.',
    ],
    'phone_auth_confirm' => [
        'required' => '인증 코드를 입력해 주세요.',
        'minmax' => '휴대폰 번호의 자리수를 확인해 주세요.',
        'numeric' => '휴대폰 번호는 숫자로만 입력해 주세요.',
        'verified' => '이미 인증이 완료 되었습니다.',
        'auth_code_fail_verified' => '이미 인증 완료한 코드 입니다.',
        'auth_code_fail' => '인증 코드를 확인해 주세요.',
        'auth_code_compare_fail' => '정확한 인증 코드를 입력해 주세요.',
        'message_server_error' => '메세지 서버 오류 발생!',
        'message_server_number_not_valid' =>'유효하지 않는 휴대폰 번호입니다.',
        'auth_limit_validation' => '일일 휴대폰 인증 횟수를 초과하였습니다.'
    ],
    'attempt' => [
        'required' => [
            'auth_index' => '휴대폰 인증을 해야 가입할수 있습니다.',
            'user_id' => '로그인 아이디를 입력해 주세요.',
            'user_password' => '패스워드를 입력해 주세요.',
            'user_password_confirm' => '패스워드 확인을 입력해 주세요.',
            'user_password_same' => '패스워드와 패스워드 확인은 같아야 합니다.',
            'user_name' => '사용자 이름을 입력해 주세요.',
            'user_email' => '사용자 이메일을 입력해 주세요.'
        ],
        'auth_code' => [
            'exists' => '존재 하지 않은 인증 정보 입니다.',
            'yet_verified' => '휴대폰 인증을 진행 해야 합니다.',
            'verified' => '이미 인증 받은 인증 정보 입니다.'
        ],
        'user_id' => [
            'check' => '정확한 아이디를 입력해 주세요. (길이 : 5~20자, 첫글자 숫자 사용 불가, 특수 기호 사용 불가)',
            'unique' => '이미 사용중인 아이디 입니다.',
        ],
        'password' => [
            'check' => '정확한 패스워드를 입력해 주세요. (길이 : 5~20자)',
        ],
        'email' => [
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
        'prohibit_user_id' => '사용할수 없는 아이디 입니다.',
        'prohibit_user_nickname' => '사용할수 없는 사용자 이름 입니다.',
    ]
];
