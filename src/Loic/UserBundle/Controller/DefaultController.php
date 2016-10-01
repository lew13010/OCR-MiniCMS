<?php

namespace Loic\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LoicUserBundle:Default:index.html.twig');
    }
}
