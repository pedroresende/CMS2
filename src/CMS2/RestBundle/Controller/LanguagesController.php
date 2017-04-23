<?php

namespace CMS2\RestBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Route;

class LanguagesController extends Controller {

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
     *  description="Returns a language by Id",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "required"=true,
     *          "description"="Id of the language to return"
     *      }
     *  }
     * )
     * @Get("/{id}")
     */
    public function getAction($id) {
        $language = $this->getDoctrine()->getRepository('CMS2BaseBundle:Language')->find($id);

        $response = new Response();
        if (!empty($language)) {
            $serializer = $this->get('serializer');
            $json = $serializer->serialize($language, 'json', array('groups' => array('language')));

            $response->setContent($json);
        } else {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

    /**
     * @ApiDoc(
     *  description="Returns the list of Languages",
     * )
     * @Get("")
     */
    public function getAllAction() {
        $languages = $this->getDoctrine()->getRepository('CMS2BaseBundle:Language')->findAll();

        $response = new Response();
        if (!empty($languages)) {
            $serializer = $this->get('serializer');
            $json = $serializer->serialize($languages, 'json', array('groups' => array('language')));

            $response->setContent($json);
        } else {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

}
