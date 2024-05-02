<?php

namespace Controllers;

use Exception;

class AdminController 
{
    public function adminAuth()
    {
        require "Views/adminAuth.php";
    }

    public function is_admin()
    {
        $mail = $_POST['email'];
        $password = $_POST['password'];
        $is_admin = false;

        if ($mail === "Admin@gmail.com" && $password === "I'm admin")
        {
            $is_admin = true;
            require_once "Views/acceuil.php";
        } 
        else
        {
            throw new Exception("Email ou Mot de passe incorrects");
        }
    }

   public function logout ()
    {
        session_destroy();
        header('Location: ' .URL. 'acceuil');
    }

}