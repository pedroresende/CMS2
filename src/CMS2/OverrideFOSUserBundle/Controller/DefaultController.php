<?php

namespace CMS2\OverrideFOSUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CMS2OverrideFOSUserBundle:Default:index.html.twig');
    }
}
