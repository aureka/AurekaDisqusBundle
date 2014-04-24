<?php

namespace Aureka\DisqusBundle\Model;

class Disqus
{

    private $shortName;
    private $privateKey;
    private $apiKey;

    private $sso = false;


    public function __construct($short_name, $private_key, $api_key)
    {
        $this->shortName = $short_name;
        $this->privateKey = $private_key;
        $this->apiKey = $api_key;
    }


    public static function create(array $settings, $short_name) {
        $configuration = new static($short_name, $settings['private_key'], $settings['api_key']);
        if ($settings['enabled']) {
            $configuration->enableSingleSignOn();
        }
        return $configuration;
    }


    public function getShortName()
    {
        return $this->shortName;
    }


    public function enableSingleSingOn()
    {
        $this->sso = true;
        return $this;
    }


    public function isSignOnEnabled()
    {
        return $this->sso;
    }


    public function getApiKey()
    {
        return $this->apiKey;
    }


    public function getSingleSignOnHash(DisqusUser $user = null, $timestamp = null)
    {
        if (is_null($user)) {
            return null;
        }
        if (is_null($timestamp)) {
            $this->timestmap = time();
        }
        $data = array(
            'id' => $user->getDisqusId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail());
        $message = base64_encode(json_encode($data));
        $hmac = $this->encodeHash($message . ' ' . $timestamp, $this->privateKey);

        return "$message $hmac $timestamp";

    }


    private function encodeHash($data, $key) {
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
