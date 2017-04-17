<?php

namespace CMS2\OverrideFOSUserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CMS2OverrideFOSUserBundle extends Bundle
{

    public function getParent()
    {
        return 'FOSUserBundle';
    }
}