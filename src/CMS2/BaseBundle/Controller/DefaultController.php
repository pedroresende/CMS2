<?php

namespace CMS2\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CMS2BaseBundle:Default:index.html.twig');
    }
}
