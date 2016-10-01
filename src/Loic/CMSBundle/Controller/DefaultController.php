<?php

namespace Loic\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Loic\CMSBundle\Entity\Advert;
use Loic\CMSBundle\Entity\Category;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $adverts = $em->getRepository('LoicCMSBundle:Advert')->findAll();
        $categories = $em->getRepository('LoicCMSBundle:Category')->findAll();

        return $this->render('LoicCMSBundle:Default:index.html.twig', array(
            'adverts'       => $adverts,
            'categories'    => $categories,
        ));
    }
}
