<?php


namespace App\Supports;

/**
 * Class HelperClass
 * @package App\Supports
 */
class HelperClass
{
    /**
     * 테스트.
     */
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
     * 랭덤 코드 생성.
     * ex) d0e6a9f5-a114-4517-83c9-5f3ae0c035db
     * @return string
     */
    public static function uuidSecure() : string
    {

        $pr_bits = null;
        $fp = @fopen('/dev/urandom','rb');
        if ($fp !== false) {
            $pr_bits .= @fread($fp, 16);
            @fclose($fp);
        } else {
            // If /dev/urandom isn't available (eg: in non-unix systems), use mt_rand().
            $pr_bits = "";
            for($cnt=0; $cnt < 16; $cnt++){
                $pr_bits .= chr(mt_rand(0, 255));
            }
        }

        $time_low = bin2hex(substr($pr_bits,0, 4));
        $time_mid = bin2hex(substr($pr_bits,4, 2));
        $time_hi_and_version = bin2hex(substr($pr_bits,6, 2));
        $clock_seq_hi_and_reserved = bin2hex(substr($pr_bits,8, 2));
        $node = bin2hex(substr($pr_bits,10, 6));

        /**
         * Set the four most significant bits (bits 12 through 15) of the
         * time_hi_and_version field to the 4-bit version number from
         * Section 4.1.3.
         * @see http://tools.ietf.org/html/rfc4122#section-4.1.3
         */
        $time_hi_and_version = hexdec($time_hi_and_version);
        $time_hi_and_version = $time_hi_and_version >> 4;
        $time_hi_and_version = $time_hi_and_version | 0x4000;

        /**
         * Set the two most significant bits (bits 6 and 7) of the
         * clock_seq_hi_and_reserved to zero and one, respectively.
         */
        $clock_seq_hi_and_reserved = hexdec($clock_seq_hi_and_reserved);
        $clock_seq_hi_and_reserved = $clock_seq_hi_and_reserved >> 2;
        $clock_seq_hi_and_reserved = $clock_seq_hi_and_reserved | 0x8000;

        return sprintf('%08s-%04s-%04x-%04x-%012s', $time_low, $time_mid, $time_hi_and_version, $clock_seq_hi_and_reserved, $node);
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
     * 숫자로 되어 있는 휴대폰 번호 - 추가.
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
