<?php

namespace CMS2\RestBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Route;

class StatusController extends Controller {

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
     *  description="Returns all the status, or the the only one with the given id",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "required"=true,
     *          "description"="Id of the status to return"
     *      }
     *  }
     * )
     * @Get("/{id}")
     */
    public function getAction($id) {
        if ($id == "{id}") {
            $status = $this->getDoctrine()->getRepository('CMS2BaseBundle:Status')->findAll();
        } else {
            $status = $this->getDoctrine()->getRepository('CMS2BaseBundle:Status')->find($id);
        }

        $response = new Response();
        if (!empty($status)) {
            $serializer = $this->get('serializer');
            $json = $serializer->serialize($status, 'json', array('groups' => array('status')));

            $response->setContent($json);
        } else {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

    /**
     * @ApiDoc(
     *  description="Returns the list of Status",
     * )
     * @Get("")
     */
    public function getAllAction() {
        $status = $this->getDoctrine()->getRepository('CMS2BaseBundle:Status')->findAll();

        $response = new Response();
        if (!empty($status)) {
            $serializer = $this->get('serializer');
            $json = $serializer->serialize($status, 'json', array('groups' => array('status')));

            $response->setContent($json);
        } else {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }
}
