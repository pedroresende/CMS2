<?php

namespace CMS2\RestBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of BlogPostsController.
 *
 * @author Pedro Resende <pedroresende@mail.resende.biz>
 * date 14/04/2017
 */
class BlogPostsController extends Controller
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
     * Returns a blogpost by Id.
     *
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
    public function getAction($id): Response
    {
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
     * Returns the list of BlogPosts.
     *
     * @ApiDoc(
     *  description="Returns the list of BlogPosts",
     * )
     * @Get("")
     */
    public function getBlogPostsAction($offset = 0, $limit = 10): Response
    {
        $blogPosts = $this->getDoctrine()->getRepository('CMS2BaseBundle:BlogPost')->findBy([], null, $limit, $offset);

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
