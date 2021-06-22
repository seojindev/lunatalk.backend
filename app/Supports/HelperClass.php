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

    public function generateAuthNumberCode() : string
    {
        return sprintf('%04d', rand(0, 9999));
    }
}
