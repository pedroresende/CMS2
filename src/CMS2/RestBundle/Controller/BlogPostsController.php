<?php

namespace CMS2\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogPostsController extends Controller {

    public function optionsAction() {
        $response = new Response();

        $response->headers->set('Allow', 'GET, OPTIONS');

        return $response;
    }

    public function getAction($id) {
        $blogPost = $this->getDoctrine()->getRepository('CMS2BaseBundle:BlogPost')->find($id);

        $response = new Response();
        if (!empty($blogPost)) {
            $serializer = $this->get('serializer');
            $json = $serializer->serialize($blogPost, 'json', array('groups' => array('blogpost')) );

            $response->setContent($json);
        } else {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

}
