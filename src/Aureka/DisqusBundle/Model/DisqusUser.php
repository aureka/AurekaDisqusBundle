<?php

namespace Aureka\DisqusBundle\Model;

interface DisqusUser extends Disqusable
{
    public function getUsername();
    public function getEmail();
}
