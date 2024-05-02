<?php

namespace Helpers;

use Exception;

class Helpers 
{

    private static $file;

    private static $dir;

    public function __construct($file, $dir)
    {
        self::$file = $file;
        self::$dir = $dir;
    }

    public static function addPicture (): ?string
    {
        if (!isset(self::$file['name']) || empty(self::$file['name']))
            throw new Exception("Vous devez indiquer une image");

        if (!file_exists(self::$dir))
            mkdir(self::$dir,0777);

        $extension = strtolower(pathinfo(self::$file['name'], PATHINFO_EXTENSION));
        $random = rand(0, 99999);
        $target_file = self::$dir.$random. "_".self::$file['name'];

        if (!getimagesize(self::$file['tmp_name']))
            throw new Exception("Le fichier n'est pas une image");

        if($extension !== "jpg" && $extension!== "jpeg" && $extension!== "png" && $extension !=="jfif" && $extension !== "svg")
            throw new Exception("L'extension du fichier n'est pas reconnue");

        if (file_exists($target_file))
            throw new Exception("Le fichier existe déjà");

        if (self::$file['size'] > 500000)
            throw new Exception("Le fichier pèse trop");

        if (!move_uploaded_file(self::$file['tmp_name'], $target_file))
            throw new Exception("L'Ajout de l'image n'a pas fonctionné");

        else return $random. "_". self::$file['name'];
    }
}