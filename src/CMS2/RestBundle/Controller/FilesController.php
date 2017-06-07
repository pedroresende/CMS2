<?php

namespace CMS2\RestBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Route;

/**
 * Description of FilesController
 *
 * @author Pedro Resende <pedroresende@mail.resende.biz>
 * date 14/04/2017
 */
class FilesController extends Controller {

    /**
     * Returns the available REST verbs
     * 
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
     * Returns a file by it's name
     * 
     * @ApiDoc(
     *  description="Returns a file by it's name",
     *  requirements={
     *      {
     *          "name"="name",
     *          "dataType"="string",
     *          "requirement"="",
     *          "required"=true,
     *          "description"="Name of the file to be returned"
     *      }
     *  }
     * )
     * @Route(options={"segment_separators"={0="/"}})
     */
    public function getAction($name): Response {
        $file = $this->getDoctrine()->getRepository('CMS2BaseBundle:File')->findOneByName($name);

        $response = new Response();
        if (!empty($file)) {
            $file = $this->getParameter('uploaded_files') . '/' . $file->getFileName();
            $response->setContent(file_get_contents($file));
        } else {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

    /**
     * Returns a file info by Id
     * 
     * @ApiDoc(
     *  description="Returns a file info by Id",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "required"=true,
     *          "description"="Id of the file Info to return"
     *      }
     *  }
     * )
     */
    public function getInfoAction($id): Response {
        $file = $this->getDoctrine()->getRepository('CMS2BaseBundle:File')->find($id);

        $response = new Response();
        if (!empty($file)) {
            $serializer = $this->get('serializer');
            $json = $serializer->serialize($file, 'json', array('groups' => array('file')));

            $response->setContent($json);
        } else {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

}
