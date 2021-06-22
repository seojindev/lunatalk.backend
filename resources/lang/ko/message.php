<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Message
    |--------------------------------------------------------------------------
    */
    'response' => [
        'success' => '정상 전송 하였습니다.',
        'process_success' => '정상 처리 하였습니다.',
        'error' => '오류가 발생 했습니다.',
    ],

    'exception' => [
        'NotFoundHttpException' => '존재 하지 않은 요청 입니다.',
        'MethodNotAllowedHttpException' => '지원되지 않는 메서드입니다.',
        'ClientErrorException' => '잘못된 요청 입니다.',
        'ClientTypeError' => '클라이언트 정보가 존재 하지 않습니다.',
        'ServerErrorException' => '처리중 문제가 발생했습니다.',
        'loginFail' => '로그인에 실패 했습니다.',
        'PassportClient' => 'Passport 오류가 발생했습니다.',
        'error_exception' => '알수없는 내부 오류가 발생했습니다.',
        'ThrottleRequestsException' => '너무 많은 시도 입니다. 잠시후에 다시 시도해 주세요.',
        'PDOException' => '데이터 처리중 문제가 발생했습니다.',
        'ModelNotFoundException' => '데이터가 존재 하지 않습니다.',
        'ForbiddenErrorException' => '권한이 부족합니다.',
        'AuthenticationException' => '로그인이 필요한 서비스 입니다.',
    ],

    'login' => [
        'login_name_required' => '로그인 아이디를 입력해 주세요.',
        'login_name_exists' => '존재하지 않는 사용자 입니다.',
        'password_required' => '패스워드를 입력해 주세요.',
        'password_fail' => '비밀번호를 확인해 주세요.',
        'login_success' => '로그인에 성공했습니다.',
    ],

    'register' => [
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
        ]
    ],

    'required' => [
        'media_file' => '이미지를 등록해 주세요.',
    ],

    'other' => [
        'image_check' => '이미지만 등록 가능합니다.',
        'image_mimes' => '업로드 가능한 이미지가 아닙니다. (jpeg,png,jpg,gif)',
        'image_max' => '업로드 이미지 용량 초과 입니다. (2048 byte)',
        'send_phone_auth_code' => '인증코드를 발송 했습니다. 문자를 확인해 주세요.',
        'success_phone_auth_code' => '인증코드 확인이 완료 되었습니다.',
    ],

    'product' => [
        'create' => [
            'category' => [
                'required' => '상품 카테고리를 입력해 주세요.',
                'exists' => '정확한 상품 카테고리를 입력해 주세요.',
            ],
            'name' => [
                'required' => '상품 명을 입력해 주세요.',
            ],
            'option_step1' => [
                'required' => '옵션(1)을 입력해 주세요.',
                'exists' => '정확한 옵션(1)을 입력해 주세요.',
            ],
            'option_step2' => [
                'required' => '옵션(2)을 입력해 주세요.',
                'exists' => '정확한 옵션(2)을 입력해 주세요.',
            ],
            'price' => [
                'required' => '가격을 입력해 주세요.',
                'numeric' => '가격은 숫자만 입력 가능합니다.',
            ],
            'stock' => [
                'required' => '재고량을 입력해 주세요.',
                'numeric' => '재고량은 숫자만 입력 가능합니다.',
            ],
            'sale' => [
                'required' => '판매유무를 입력해 주세요.',
                'in' => '정확한 판매유무를 입력해 주세요.',
            ],
            'active' => [
                'required' => '재품상태를 입력해 주세요.',
                'in' => '정확한 재품상태를 입력해 주세요.',
            ],

            'image' => [
                'required' => '상품 이미지를 입력해 주세요',
                'numeric' => '정확한 상품 이미지를 입력해 주세요.',
                'exists' => '존재 하지 않은 상품 이미지입니다.',
            ],
            'thumbnail' => [
                'required' => '상품 썸네일 이미지를 입력해 주세요',
                'numeric' => '정확한 상품 썸네일 이미지를 입력해 주세요.',
                'exists' => '존재 하지 않은 상품 썸네일 이미지입니다.',
            ],
            'detail' => [
                'required' => '상품 상세 이미지를 입력해 주세요',
                'numeric' => '정확한 상품 상세 이미지를 입력해 주세요.',
                'exists' => '존재 하지 않은 상품 상세 이미지입니다.',
            ],
        ],
    ]

];
