<?php

namespace CMS2\RestBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of SettingsController.
 *
 * @author Pedro Resende <pedroresende@mail.resende.biz>
 * date 14/04/2017
 */
class SettingsController extends Controller
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
     * Returns all the settings.
     *
     * @ApiDoc(
     *  description="Returns all the settings",
     * )
     * @Get("")
     */
    public function getAction(): Response
    {
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
