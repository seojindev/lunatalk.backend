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

    /**
     * 랜덤 pin 번호.
     *  - 알파벳 포함.
     * ex) 65T5
     * @param $number
     * @return string
     */
    public function generatePin( $number ) : string
    {
        // Generate set of alpha characters
        $alpha = array();
        for ($u = 65; $u <= 90; $u++) {
            // Uppercase Char
            array_push($alpha, chr($u));
        }

        // Just in case you need lower case
        // for ($l = 97; $l <= 122; $l++) {
        //    // Lowercase Char
        //    array_push($alpha, chr($l));
        // }

        // Get random alpha character
        $rand_alpha_key = array_rand($alpha);
        $rand_alpha = $alpha[$rand_alpha_key];

        // Add the other missing integers
        $rand = array($rand_alpha);
        for ($c = 0; $c < $number - 1; $c++) {
            array_push($rand, mt_rand(0, 9));
            shuffle($rand);
        }

        return implode('', $rand);
    }

    /**
     * 랜덤 번호.
     *  - 숫자만.
     * ex) 0012
     * @return string
     */
    public function generateAuthNumberCode() : string
    {
        return sprintf('%04d', rand(0, 9999));
    }

    /**
     * 회원 로그인 아이디 금지어 체크
     * @param String $checkWord
     * @return bool
     */
    public static function checkProhibitLoginId(String $checkWord) : bool
    {
        $prohibitWord = explode(',', config('extract.prohibit.login_id'));
        foreach ($prohibitWord as $element):
            $tmpWord = trim($element);
            if (preg_match("/{$tmpWord}/i", $checkWord)) {
//            if (strpos( $this->currentRequest->input('user_id'), $tmpWord) !== false) {
                return true;
            }
        endforeach;

        return false;
    }

    /**
     * 회원 닉네임 금지어 체크.
     * @param String $checkWord
     * @return bool
     */
    public static function checkProhibitUserNickname(String $checkWord) : bool
    {
        $prohibitWord = explode(',', config('extract.prohibit.nickname'));
        foreach ($prohibitWord as $element):
            $tmpWord = trim($element);
            if (preg_match("/{$tmpWord}/i", $checkWord)) {
//            if (strpos( $this->currentRequest->input('user_id'), $tmpWord) !== false) {
                return true;
            }
        endforeach;

        return false;
    }

    /**
     * 문자열중 금지어 체크.
     * @param String $checkWord
     * @return bool
     */
    public static function checkProhibitWord(String $checkWord) : bool
    {
        $prohibitWord = explode(',', config('extract.prohibit.word'));
        foreach ($prohibitWord as $element):
            $tmpWord = trim($element);
            if (preg_match("/{$tmpWord}/i", $checkWord)) {
//            if (strpos( $this->currentRequest->input('user_id'), $tmpWord) !== false) {
                return true;
            }
        endforeach;

        return false;
    }

    /**
     * @param String $phonenumber
     * @return string
     */
    public static function phoneNumberAddHyphen(String $phonenumber) : string
    {
        $phonenumber = preg_replace("/[^0-9]*/s","",$phonenumber);

        if (substr($phonenumber,0,2) == '02' ) {
            return preg_replace("/([0-9]{2})([0-9]{3,4})([0-9]{4})$/","\\1-\\2-\\3", $phonenumber);
        }else if(substr($phonenumber,0,2) =='8' && substr($phonenumber,0,2) =='15' || substr($phonenumber,0,2) =='16'||  substr($phonenumber,0,2) =='18'  ) {
            return preg_replace("/([0-9]{4})([0-9]{4})$/","\\1-\\2", $phonenumber);
        } else {
            return preg_replace("/([0-9]{3})([0-9]{3,4})([0-9]{4})$/","\\1-\\2-\\3" ,$phonenumber);
        }
    }

}
