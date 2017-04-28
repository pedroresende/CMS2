<?php

namespace CMS2\RestBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Route;

class SettingsController extends Controller {

    /**
     * @ApiDoc(
     *  description="Returns the available REST verbs"
     * )
     * 
     */
    public function optionsAction() {
        $response = new Response();

        $response->headers->set('Allow', 'GET, OPTIONS');

        return $response;
    }

    /**
     * @ApiDoc(
     *  description="Returns all the settings",
     * )
     * @Get("")
     */
    public function getAction() {
        $section = $this->getDoctrine()->getRepository('CMS2BaseBundle:Setting')->find(1);

        $response = new Response();
        if (!empty($section)) {
            $serializer = $this->get('serializer');
            $json = $serializer->serialize($section, 'json', array('groups' => array('settings')));

            $response->setContent($json);
        } else {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

}
