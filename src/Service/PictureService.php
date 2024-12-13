<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
class PictureService
{

    public function freeresize(UploadedFile $picture, string $folder = ''): string
    {

        //formatage du nom original..
        $fileName = $picture->getClientOriginalName();
        $formatName = '';

        if(preg_match('/\.[a-zA-Z]{3}$/', $fileName)){
            $formatName = preg_replace(['/\.[a-zA-Z]{3}$/', '/ /'], ['', ''], $fileName) . '.jpg';
        }else{
            $formatName =  preg_replace('/ /', '' ,$fileName)  . '.jpg';
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
        }

        
    }

    public function squaresize(UploadedFile $picture, string $folder = ''): string
    {

        //formatage du nom original..
        $fileName = $picture->getClientOriginalName();
        $formatName = '';

        if(preg_match('/\.[a-zA-Z]{3}$/', $fileName)){
            $formatName = preg_replace(['/\.[a-zA-Z]{3}$/', '/ /'], ['', ''], $fileName) . '.jpg';
        }else{
            $formatName = preg_replace('/ /', '', $fileName) . '.jpg';
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

            $sourceImage = imagecreatefromjpeg($picture);
            $squareSize = 0 ;
            $scrX = ($sourceWidth - $sourceHeight) / 2;

            if($sourceHeight > 720){

                $squareSize = 720;
                
            }else{

                $squareSize = $sourceHeight;

            }

            $newImage = imagecreatetruecolor($sourceHeight, $sourceHeight);

            imagecopy($newImage, $sourceImage, 0, 0, $scrX, 0, $sourceHeight, $sourceHeight);

            $resizeImage = imagecreatetruecolor($squareSize, $squareSize);

            imagecopyresampled($resizeImage, $newImage, 0, 0, $scrX, 0, $squareSize, $squareSize, $sourceHeight, $sourceHeight);

            imagejpeg($newImage, $folder . $formatName, 100);

            imagedestroy($sourceImage);
            imagedestroy($newImage);

            return $formatName;
        }

        
    }
}