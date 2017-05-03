<?php

namespace CMS2\RestBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of PagesController
 *
 * @author Pedro Resende <pedroresende@mail.resende.biz>
 * @date 14/04/2017
 */
class PagesController extends Controller {

    /**
     * @ApiDoc(
     *  description="Returns the available REST verbs"
     * )
     * 
     */
    public function optionsAction(): Response {
        $response = new Response();

        $response->headers->set('Allow', 'GET, OPTIONS');

        return $response;
    }

    /**
     * @ApiDoc(
     *  description="Returns a page by Id",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "required"=true,
     *          "description"="Id of the page to return"
     *      }
     *  }
     * )
     * @Get("/{id}")
     */
    public function getAction($id): Response {
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

    /**
     * @ApiDoc(
     *  description="Returns the list of Pages",
     * )
     * @Get("")
     */
    public function getAllAction(): Response {
        $pages = $this->getDoctrine()->getRepository('CMS2BaseBundle:Page')->findAll();

        $response = new Response();
        if (!empty($pages)) {
            $serializer = $this->get('serializer');
            $json = $serializer->serialize($pages, 'json', array('groups' => array('page')));

            $response->setContent($json);
        } else {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

}
