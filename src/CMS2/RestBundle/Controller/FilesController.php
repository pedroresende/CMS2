<?php

namespace CMS2\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Route;

class FilesController extends Controller {

    public function optionsAction() {
        $response = new Response();

        $response->headers->set('Allow', 'GET, OPTIONS');

        return $response;
    }

    /**
    * @Route(options={"segment_separators"={0="/"}})
    */
    public function getAction($name) {
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

    public function getInfoAction($id) {
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
