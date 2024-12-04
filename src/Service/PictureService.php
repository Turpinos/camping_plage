<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\AsciiSlugger;

class PictureService
{
    public function freeresize(UploadedFile $picture, string $folder = ''): string
    {

        //formatage du nom original..
        $fileName = $picture->getClientOriginalName();
        $formatName = '';
        $slugger = new AsciiSlugger();

        if(str_contains($fileName, '.')){
            $formatName = explode('.', $fileName, 2);
            $formatName = $slugger->slug($formatName[0]) . '.jpg';
        }else{
            $formatName = $slugger->slug($fileName) . '.jpg';
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

        //redimensionnement de l'image..
        $file = getimagesize($picture);
        $sourceWidth = $file[0];
        $sourceHeight = $file[1];

        if($file['mime'] == 'image/jpeg'){

            if($sourceHeight > 720){

                $sourceImage = imagecreatefromjpeg($picture);

                $ratio = 720 / $sourceHeight;
                $newHeight = 720;
                $newWidth = floor($sourceWidth * $ratio);

                $newImage = imagecreatetruecolor($newWidth, $newHeight);

                imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $sourceWidth, $sourceHeight);

                imagejpeg($newImage, $folder . $formatName, 100);

                imagedestroy($sourceImage);
                imagedestroy($newImage);
                
            }else {

                $destination = $folder . $formatName;
                move_uploaded_file($picture, $destination);

            }

            return $formatName;
        }else{

            return 'erreur';

        }

        
    }
}