<?php

namespace Aureka\DisqusBundle\Model;

class SingleSignOn
{

    public static function fromArray(array $settings) {
        $sso = new static();
        if ($settings['enabled']) {
            $sso->enable();
        }
        return $sso;
    }
}
