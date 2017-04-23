<?php

namespace CMS2\RestBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AliasController extends Controller {

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
     *  description="Returns all the alias, or the the only one with the given id",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "required"=false,
     *          "description"="Id of the alias to return"
     *      }
     *  }
     * )
     * @Get("/{id}", defaults={"id" = null})
     */
    public function getAction($id) {
        if ($id == "{id}") {
            $alias = $this->getDoctrine()->getRepository('CMS2BaseBundle:Alias')->findAll();
        } else {
            $alias = $this->getDoctrine()->getRepository('CMS2BaseBundle:Alias')->find($id);
        }

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

    /**
     * @ApiDoc(
     *  description="Returns a alias by url",
     *  requirements={
     *      {
     *          "name"="slug",
     *          "dataType"="string",
     *          "requirement"="",
     *          "required"=true,
     *          "description"="The Url of the alias to return"
     *      }
     *  }
     * )
     */
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
