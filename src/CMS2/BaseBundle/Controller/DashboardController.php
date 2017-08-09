<?php

namespace CMS2\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Description of DashboardController
 *
 * @author Pedro Resende <pedroresende@mail.resende.biz>
 */
class DashboardController extends Controller
{

    /**
     * Controller responsible for fetching the content from client_secret.json file
     * and return the ACCESS_TOKEN_FROM_SERVICE_ACCOUNT to the analytics dashboard
     *
     * @param Symfony\Component\HttpFoundation\Request $request
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request): Response
    {
        try {
            $scope = 'https://www.googleapis.com/auth/analytics';
            $jsonKey = $this->get('kernel')->getRootDir() . '/config/client_secret.json';

            $client = new \Google_Client();
            $client->setScopes([$scope]);
            $client->setAuthConfig($jsonKey);

            $client->useApplicationDefaultCredentials();
            $client->fetchAccessTokenWithAssertion();

            $accessToken = $client->getAccessToken()['access_token'];
        } catch (\InvalidArgumentException $ex) {
            $accessToken = "invalid";
        }

        return $this->render(
            'default/dashboard.html.twig',
            [
                'ACCESS_TOKEN_FROM_SERVICE_ACCOUNT' => $accessToken
            ]
        );
    }

    /**
     * Controller responsible for clearing symfony's cache
     *
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function cacheClearAction(): Response
    {
        $fs = new Filesystem();
        $fs->remove($this->container->getParameter('kernel.cache_dir'));

        $response = new Response();
        $response->setStatusCode(Response::HTTP_OK);
        $response->setContent('Cache Cleared');

        return $response;
    }
}
