<?php

namespace CMS2\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of DashboardController
 *
 * @author pedroresende
 */
class DashboardController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('default/dashboard.html.twig');
    }
}