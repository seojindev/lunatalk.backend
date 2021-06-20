<?php


namespace App\Supports;


class HelperClass
{
    public function test()
    {
        echo 'HelperClass';
    }

    /**
     * 랜덤 넘버 UUID 생성.
     * 34930722151-50988287951-1690522742
     * @return string
     */
    public function randomNumberUUID(): string
    {
        return
            str_pad(rand(0,'6'.round(microtime(true))),11, "0", STR_PAD_LEFT)
            .'-'.str_pad(rand(0,'9'.round(microtime(true))),11, "0", STR_PAD_LEFT)
            .'-'.str_pad(rand(0,'3'.round(microtime(true))),11, "0", STR_PAD_LEFT);
    }
}
