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
        'notfound' => '존재 하지 않은 요청 입니다.',
        'notallowedmethod' => '지원되지 않는 메서드입니다.',
        'clienttype' => '클라이언트 정보가 존재 하지 않습니다.',
        'loginFail' => '로그인에 실패 했습니다.',
        'passport_client' => 'Passport 오류가 발생했습니다.',
        'error_exception' => '알수없는 내부 오류가 발생했습니다.',
        'throttle_exception' => '너무 많은 시도 입니다. 잠시후에 다시 시도해 주세요.',
        'pdo_exception' => '데이터 처리중 문제가 발생했습니다.',
        'model_not_found_exception' => '데이터가 존재 하지 않습니다.',
        'forbidden_error_exception' => '권한이 부족합니다.',
    ],

];
