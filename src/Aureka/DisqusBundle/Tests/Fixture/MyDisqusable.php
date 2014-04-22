<?php

namespace Aureka\DisqusBundle\Tests\Fixture;

use Aureka\DisqusBundle\Model\Disqusable;

class MyDisqusable implements Disqusable
{

    public function getDisqusId()
    {
        return 'my_id';
    }

}