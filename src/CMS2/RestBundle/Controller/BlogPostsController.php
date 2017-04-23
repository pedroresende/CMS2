<?php

namespace CMS2\RestBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogPostsController extends Controller {

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
     *  description="Returns a blogpost by Id",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "required"=true,
     *          "description"="Id of the blogpost to return"
     *      }
     *  }
     * )
     * @Get("/{id}")
     */
    public function getAction($id) {
        $blogPost = $this->getDoctrine()->getRepository('CMS2BaseBundle:BlogPost')->find($id);

        $response = new Response();
        if (!empty($blogPost)) {
            $serializer = $this->get('serializer');
            $json = $serializer->serialize($blogPost, 'json', array('groups' => array('blogpost')));

            $response->setContent($json);
        } else {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

    /**
     * @ApiDoc(
     *  description="Returns the list of BlogPosts",
     * )
     * @Get("")
     */
    public function getAllAction() {
        $blogPosts = $this->getDoctrine()->getRepository('CMS2BaseBundle:BlogPost')->findAll();

        $response = new Response();
        if (!empty($blogPosts)) {
            $serializer = $this->get('serializer');
            $json = $serializer->serialize($blogPosts, 'json', array('groups' => array('blogpost')));

            $response->setContent($json);
        } else {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }
}
