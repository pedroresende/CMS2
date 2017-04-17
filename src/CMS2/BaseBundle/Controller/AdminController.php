<?php

namespace CMS2\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Debug\ErrorHandler;
use Xvolutions\AdminBundle\Helpers\Upload;
use Xvolutions\AdminBundle\Entity\File;

class AdminController extends BaseAdminController
{

/*
    public function indexAction(Request $request)
    {
        $files_location  = $this->container->getParameter('files_location');
        return $this->render('CMS2BaseBundle:files:files.html.twig',
                array(
                'files_location' => $files_location
        ));
    }*/

    public function newfileAction()
    {
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
