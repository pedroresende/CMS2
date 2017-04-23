<?php

namespace CMS2\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AliasController extends Controller {

    public function optionsAction() {
        $response = new Response();

        $response->headers->set('Allow', 'GET, OPTIONS');

        return $response;
    }

    public function getAction($id) {
        $alias = $this->getDoctrine()->getRepository('CMS2BaseBundle:Alias')->find($id);

        $response = new Response();
        if (!empty($alias)) {
            $serializer = $this->get('serializer');
            $json = $serializer->serialize($alias, 'json', array('groups' => array('alias')));

            $response->setContent($json);
        } else {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

    public function getUrlAction($slug) {
        $alias = $this->getDoctrine()->getRepository('CMS2BaseBundle:Alias')->findOneByUrl($slug);

        $response = new Response();
        if (!empty($alias)) {
            $serializer = $this->get('serializer');
            $json = $serializer->serialize($alias, 'json', array('groups' => array('alias')));

            $response->setContent($json);
        } else {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

}
