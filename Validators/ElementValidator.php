<?php

namespace Validators;

use Exception;

class ElementValidator
{

    private static $title;

    private static $content;

    private static $price;

    private static $errors = [];

    public function __construct($title, $content, $price)
    {
        self::$title =  nl2br(htmlentities($title));
        self::$content = nl2br(htmlentities($content));
        self::$price = nl2br(htmlentities($price));
    }

    public static function inputsContentValidate ():array
    {
        if (empty(self::$title))
        {
            self::$errors[] = "Le Titre ne peut pas être vide";
        }

        if (mb_strlen(self::$title) < 2 || mb_strlen(self::$title) > 80)
        {
            self::$errors[] = "Le Titre doit être compris entre 2 et 80 caractères";
        }

        if (empty(self::$content))
        {
            self::$errors[] = "Le Contenu ne peut pas être vide";
        }

        if (mb_strlen(self::$content) < 50)
        {
            self::$errors[] = "Le Contenu doit dépasser 50 caractères";
        } 

        if (self::$price <= 0)
        {
            self::$errors[] = "Le Prix doit être supérieur à 0$";
        } 

        if (count(self::$errors) > 0)
        {
            array_map(function($error){
                throw new Exception($error);
            }, self::$errors);
        }

        else return [self::$title, self::$content, self::$price];
    }
}