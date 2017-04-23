<?php

namespace CMS2\RestBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Route;

class SectionsController extends Controller {

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
     *  description="Returns all the sections, or the the only one with the given id",
     *  parameters={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "required"=false,
     *          "description"="Id of the section to return"
     *      }
     *  }
     * )
     * @Get("/{id}", defaults={"id" = null})
     */
    public function getAction($id) {
        if ($id == "{id}") {
            $section = $this->getDoctrine()->getRepository('CMS2BaseBundle:Section')->findAll();
        } else {
            $section = $this->getDoctrine()->getRepository('CMS2BaseBundle:Section')->find($id);
        }

        $response = new Response();
        if (!empty($section)) {
            $serializer = $this->get('serializer');
            $json = $serializer->serialize($section, 'json', array('groups' => array('section')));

            $response->setContent($json);
        } else {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

}
