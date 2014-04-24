<?php

namespace Aureka\DisqusBundle\Model;

class DisqusConfiguration
{

    public static function fromArray(array $settings) {
        $configuration = new static();
        if ($settings['enabled']) {
            $configuration->enableSingleSignOn();
        }
        return $configuration;
    }
}
