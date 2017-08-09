<?php

namespace CMS2\BaseBundle\Helper;

use Symfony\Component\HttpFoundation\Request;

/**
 * Description of Upload.
 *
 * @author Pedro Resende <pedroresende@mail.resende.biz>
 * date 14/08/2014
 */
class UploadHelper
{
    /**
     * This function is responsible to deal with the uploaded file.
     *
     * @param Request $request
     * @param string  $folder           The destination folder
     * @param string  $fileName         The new generated name
     * @param string  $originalFileName The original filename
     * @param int     $size             The size of the File
     * @param string  $type             The file type
     *
     * @return bool Always returns true
     */
    public function upload(Request $request, $folder, &$fileName, &$originalFileName, &$size, &$type): boolean
    {
        $status = true;
        foreach ($request->files as $uploadedFile) {
            $type = $uploadedFile->guessClientExtension();
            $originalFileName = $uploadedFile->getClientOriginalName();
            $fileName = md5(time()).'.'.$type;
            $size = filesize($uploadedFile);
            $uploadedFile->move($folder, $fileName);
        }

        return $status;
    }
}
