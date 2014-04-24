<?php

namespace Aureka\DisqusBundle\Model;

class DisqusEncoder
{
    public static function generate(array $data, $private_key, $timestamp = null)
    {
        if (is_null($timestamp)) {
            $timestamp = time();
        }
        $message = base64_encode(json_encode($data));
        $hmac = self::encodeHash($message . ' ' . $timestamp, $private_key);

        return "$message $hmac $timestamp";

    }


    private static function encodeHash($data, $key) {
        $blocksize=64;
        $hashfunc='sha1';
        if (strlen($key)>$blocksize)
            $key=pack('H*', $hashfunc($key));
        $key=str_pad($key,$blocksize,chr(0x00));
        $ipad=str_repeat(chr(0x36),$blocksize);
        $opad=str_repeat(chr(0x5c),$blocksize);
        $hmac = pack(
                    'H*',$hashfunc(
                        ($key^$opad).pack(
                            'H*',$hashfunc(
                                ($key^$ipad).$data
                            )
                        )
                    )
                );
        return bin2hex($hmac);
    }
}