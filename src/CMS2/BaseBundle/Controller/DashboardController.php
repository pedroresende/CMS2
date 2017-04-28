<?php

namespace CMS2\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Description of DashboardController
 *
 * @author pedroresende
 */
class DashboardController extends Controller
{

    public function indexAction(Request $request)
    {
        $scope = 'https://www.googleapis.com/auth/analytics';
        $jsonKey = $this->get('kernel')->getRootDir() . '/config/client_secret.json';

        $client = new \Google_Client();
        $client->setScopes([$scope]);
        $client->setAuthConfig($jsonKey);

        $client->useApplicationDefaultCredentials();
        $client->fetchAccessTokenWithAssertion();

        $accessToken = $client->getAccessToken()['access_token'];

        return $this->render(
            'default/dashboard.html.twig',
            [
                'ACCESS_TOKEN_FROM_SERVICE_ACCOUNT' => $accessToken
            ]
        );
    }

    public function cacheClearAction()
    {
        $fs = new Filesystem();
        $fs->remove($this->container->getParameter('kernel.cache_dir'));

        $response = new Response();
        $response->setStatusCode(Response::HTTP_OK);
        $response->setContent('Cache Cleared');

        return $response;
    }
}
