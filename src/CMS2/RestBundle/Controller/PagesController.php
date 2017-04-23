<?php

namespace CMS2\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PagesController extends Controller {

    public function optionsAction() {
        $response = new Response();

        $response->headers->set('Allow', 'GET, OPTIONS');

        return $response;
    }

    public function getAction($id) {
        $page = $this->getDoctrine()->getRepository('CMS2BaseBundle:Page')->find($id);

        $response = new Response();
        if (!empty($page)) {
            $serializer = $this->get('serializer');
            $json = $serializer->serialize($page, 'json', array('groups' => array('page')));

            $response->setContent($json);
        } else {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

}
