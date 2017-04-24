<?php

namespace CMS2\RestBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CMS2\BaseBundle\Entity\Contact;
use Symfony\Component\Serializer\Serializer;

class ContactsController extends Controller {

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
     *  description="Returns a contact by Id",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "required"=true,
     *          "description"="Id of the page to return"
     *      }
     *  }
     * )
     * @Get("/{id}")
     */
    public function getAction($id) {
        $page = $this->getDoctrine()->getRepository('CMS2BaseBundle:Contact')->find($id);

        $response = new Response();
        if (!empty($page)) {
            $serializer = $this->get('serializer');
            $json = $serializer->serialize($page, 'json', array('groups' => array('contact')));

            $response->setContent($json);
        } else {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

    /**
     * @ApiDoc(
     *  description="Returns the list of Contacts",
     * )
     * @Get("")
     */
    public function getAllAction() {
        $pages = $this->getDoctrine()->getRepository('CMS2BaseBundle:Contact')->findAll();

        $response = new Response();
        if (!empty($pages)) {
            $serializer = $this->get('serializer');
            $json = $serializer->serialize($pages, 'json', array('groups' => array('contact')));

            $response->setContent($json);
        } else {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

    
    /**
     * @ApiDoc(
     *  description="Post a contact",
     * )
     */
    public function postAction(Request $request) {
        $data = json_decode($request->getContent(), true);

        $response = new Response();
        try {
            $contact = new Contact();
            $contact->setName($data['name']);
            $contact->setEmail($data['email']);
            $contact->setMessage($data['message']);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            $response->setStatusCode(Response::HTTP_CREATED);
        } catch (Exception $ex) {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }

}
