<?php

namespace CMS2\RestBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of StatusController.
 *
 * @author Pedro Resende <pedroresende@mail.resende.biz>
 * date 14/04/2017
 */
class StatusController extends Controller
{
    /**
     * Returns the available REST verbs.
     * 
     * @ApiDoc(
     *  description="Returns the available REST verbs"
     * )
     */
    public function optionsAction(): Response
    {
        $response = new Response();

        $response->headers->set('Allow', 'GET, OPTIONS');

        return $response;
    }

    /**
     * Returns all the status, or the the only one with the given id.
     * 
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
    public function getAction($id): Response
    {
        if ($id == '{id}') {
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
     * Returns the list of Status.
     * 
     * @ApiDoc(
     *  description="Returns the list of Status",
     * )
     * @Get("")
     */
    public function getAllAction(): Response
    {
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
