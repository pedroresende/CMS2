<?php

namespace CMS2\RestBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Post;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Description of AliasController.
 *
 * @author Pedro Resende <pedroresende@mail.resende.biz>
 * date 14/04/2017
 */
class CacheController extends Controller
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
     * Clears Symfony cache
     *
     * @ApiDoc(
     *  description="Clears Symfony cache"
     * )
     * @Post("")
     */
    public function postAction(): Response
    {
        $fs = new Filesystem();
        $fs->remove($this->container->getParameter('kernel.cache_dir'));

        $response = new Response();
        $response->setStatusCode(Response::HTTP_OK);
        $response->setContent('Cache Cleared');

        return $response;
    }
}