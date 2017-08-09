<?php

namespace CMS2\RestBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of SectionsController.
 *
 * @author Pedro Resende <pedroresende@mail.resende.biz>
 * date 14/04/2017
 */
class SectionsController extends Controller
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
     * Returns all the sections, or the the only one with the given id.
     *
     * @ApiDoc(
     *  description="Returns all the sections, or the the only one with the given id",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "required"=true,
     *          "description"="Id of the section to return"
     *      }
     *  }
     * )
     * @Get("/{id}")
     */
    public function getAction($id): Response
    {
        if ($id == '{id}') {
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

    /**
     * Returns the list of Sections.
     *
     * @ApiDoc(
     *  description="Returns the list of Sections",
     * )
     * @Get("")
     */
    public function getAllAction(): Response
    {
        $sections = $this->getDoctrine()->getRepository('CMS2BaseBundle:Section')->findAll();

        $response = new Response();
        if (!empty($sections)) {
            $serializer = $this->get('serializer');
            $json = $serializer->serialize($sections, 'json', array('groups' => array('section')));

            $response->setContent($json);
        } else {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }
}
