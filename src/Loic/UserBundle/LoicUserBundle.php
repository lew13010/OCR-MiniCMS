<?php

namespace Loic\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LoicUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
