<?php

namespace Validators;

use Exception;
use Models\UserManager;

class UserValidator
{

    private static $userManager;
    private static $username;
    private static $mail;
    private static $password;
    private static $errors = [];

    public function __construct($username, $mail, $password)
    {
        self::$username =  nl2br(htmlentities($username));
        self::$mail = nl2br(htmlentities($mail));
        self::$password = nl2br(htmlentities($password));
        self::$userManager = new UserManager;
        self::$userManager->loadUsers();
        self::$userManager->getUsers();
    }

    public static function inputsContentValidate ():array
    {
        if (empty(self::$username))
        {
            self::$errors[] = "Le Nom d'Utilisateur ne peut pas être vide";
        }

        if (mb_strlen(self::$username) < 4 || mb_strlen(self::$username) > 80)
        {
            self::$errors[] = "Le Nom d'Utilisateur doit être compris entre 4 et 12 caractères";
        }

        if (empty(self::$mail))
        {
            self::$errors[] = "L'Email ne peut pas être vide";
        }

        if (!filter_var(self::$mail, FILTER_VALIDATE_EMAIL))
        {
            self::$errors[] = "Le Format de l'Email est incorrect";
        } 

        if (empty(self::$password))
        {
            self::$errors[] = "Le Mot de Passe ne peut pas être vide";
        }

        if (!preg_match("/[0-9]/", self::$password))
        {
            self::$errors[] = "Le Mot de Passe doit contenir au moins un chiffre";
        }

        if (!preg_match("/[A-Z]/", self::$password))
        {
            self::$errors[] = "Le Mot de Passe doit contenir au moins une lettre majuscule";
        }

        if (mb_strlen(self::$password) < 6)
        {
            self::$errors[] = "Le Mot de Passe doit contenir au moins 6 caractères";
        }

        if (count(self::$errors) > 0)
        {
            array_map(function($error){
                throw new Exception($error);
            }, self::$errors);
        }

        else return [self::$username, self::$mail, self::$password];
    }

    public function exists()
    {

        if (self::$userManager->findUserByUsername(self::$username) !== null)
        {
            self::$errors[] = "Le Nom d'Utilisateur existe déjà en Base de données";
        }

        if (self::$userManager->findUserByMail(self::$mail) !== null)
        {
            self::$errors[] = "L'Email existe déjà en Base de données";
        }

        if (count(self::$errors) > 0)
        {
            array_map(function($error){
                throw new Exception($error);
            }, self::$errors);
        }
        else return [self::$username, self::$mail, self::$password];
    }

}