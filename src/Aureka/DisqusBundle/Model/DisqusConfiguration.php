<?php

namespace Aureka\DisqusBundle\Model;

class DisqusConfiguration
{

    private $shortName;


    public function __construct($short_name)
    {
        $this->shortName = $short_name;
    }


    public static function create(array $settings, $short_name) {
        $configuration = new static($short_name);
        if ($settings['enabled']) {
            $configuration->enableSingleSignOn();
        }
        return $configuration;
    }


    public function getShortName()
    {
        return $this->shortName;
    }
}
