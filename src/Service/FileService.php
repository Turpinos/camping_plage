<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileService
{

    public function uploadPdf(UploadedFile $file, string $folder = ''): string
    {

        //formatage du nom original..
        $fileName = $file->getClientOriginalName();
        $formatName = '';

        if(preg_match('/\.[a-zA-Z]{3}$/', $fileName)){
            $formatName = preg_replace(['/\.[a-zA-Z]{3}$/', '/ /'], ['', ''], $fileName) . '.pdf';
        }else{
            $formatName = preg_replace('/ /', '', $fileName) . '.pdf';
        }
            
        //Verification d'un doublon existentiel..
        $repertoire = scandir($folder);
        $doublon = false;

        foreach ($repertoire as $fichier) {
            if($formatName == $fichier){
                $doublon = true;
            }
        }

        if ($doublon) {
            $formatName = str_replace('.', md5($formatName) . '.', $formatName);
        }

        $destination = $folder . $formatName;
        move_uploaded_file($file, $destination);

        return $formatName;
    }
}