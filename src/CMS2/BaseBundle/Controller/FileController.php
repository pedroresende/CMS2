<?php

namespace CMS2\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Debug\ErrorHandler;
use CMS2\BaseBundle\Entity\File;

class FileController extends Controller
{

    /**
     * Controller responsible to return the list of images uploaded to the database
     * to be used by TinyMCE
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function imageListAction(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');

        $imageTypes = array('gif', 'jpeg', 'png', 'tiff', 'bmp');
        $files      = $this->getDoctrine()->getRepository('CMS2BaseBundle:File')->findAll();
        $folder     = $this->container->getParameter('files_location');

        $arrayOfFiles = array();
        foreach ($files as $file) {
            $type = $file->getType();
            if (in_array($type, $imageTypes)) {
                $tempArray = ['title' => $file->getName(), 'value' => $folder.$file->getFileName()];
                array_push($arrayOfFiles, $tempArray);
            }
        }

        $jsonResponse = json_encode($arrayOfFiles);

        return new Response($jsonResponse, '200');
    }

    /**
     * Controller responsible to add a new file
     *
     * @param Request $request The request to be processed
     * @param type $current_page the actual page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newfileAction(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');

        $upload           = $this->get('file.uploader.helper');
        $folder           = $this->container->getParameter('uploaded_files');
        $fileName         = null;
        $originalFileName = null;
        $size             = null;
        $type             = null;
        $status           = null;
        $error            = null;
        if ($upload->upload($request, $folder, $fileName, $originalFileName,
                $size, $type)) {
            $name = $this->getDoctrine()->getRepository('CMS2BaseBundle:File')->findByName($originalFileName);
            if (count($name) > 0) {
                @unlink($folder.'/'.$fileName);
                $error = "Já existe um ficheiro com esse nome";
                return new Response($error, Response::HTTP_NOT_ACCEPTABLE);
            } else {
                $file     = new File();
                $datetime = new \DateTime('now');
                $file->setDate($datetime);
                $file->setFileName($fileName);
                $file->setName($originalFileName);
                $file->setType($type);
                $file->setSize($size);
                $em       = $this->getDoctrine()->getManager();
                $em->persist($file);
                $em->flush();
                $status   = 'Ficheiro adicionado com sucesso';
                return new Response($status, Response::HTTP_CREATED);
            }
        } else {
            $error = "Impossível enviar o ficheiro";
            return new Response($error, Response::HTTP_NOT_ACCEPTABLE);
        }
    }
}
