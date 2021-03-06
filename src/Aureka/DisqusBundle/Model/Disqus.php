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


    public function enableSingleSignOn()
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


    public function getSingleSignOnHash(DisqusUser $user = null)
    {
        if (is_null($user)) {
            return null;
        }
        $data = array(
            'id' => $user->getDisqusId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail());
        return DisqusEncoder::generate($data, $this->privateKey);
    }
}
