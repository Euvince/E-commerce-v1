<?php

namespace Controllers;

use Models\UserManager;
use Validators\UserValidator;

class UserController extends GeneralController
{

    private $userManager;

    public function __construct()
    {
        $searching = isset($_POST['searching']) ? htmlspecialchars($_POST['searching']) : "";
        $this->userManager = new UserManager;
        $this->userManager->loadUsers($searching);
    }

    public function ul()
    {
        require "Views/login.php";
    }

    public function ur()
    {
        require "Views/register.php";
    }

    public function login ()
    {
        $user = $this->userManager->findUserByMail($_POST['mail']);
        if ($user !== null && $user->getPassword() === $_POST['password'])
        {
            if (session_status() === PHP_SESSION_NONE){
                session_start();
            }
            $_SESSION['user'] = $user->getMail();
            $response = ['success' => true];
        }
        else 
        {
            $response = ['success' => false];
        }
        header ('Content-Type: application/json');
        echo json_encode($response);
    }

    public function register ()
    {
        /*$v = new Validator($_POST);
        if(!$v->validate())
        {
            $i = 0;
            array_map(function($error) use($i) {
                throw new Exception($error[$i]);
                $i++;
            }, $v->errors());
        }*/

        $findUserByMail = $this->userManager->findUserByMail($_POST['mail']);
        if($findUserByMail !== null) $response = ['success01' => true];
        else
        {
            if(!empty($_POST['username']) && !empty($_POST['mail']) && !empty($_POST['password']) && !empty($_FILES['picture']))
            {
                $file = $_FILES['picture'];
                $directory = 'img/';
                $picture = $this->instanceOfHelpers($file, $directory)->addPicture();
                $this->userManager->
                    insertUserIntoDatabase(
                        $_POST['username'],
                        $_POST['mail'],
                        $_POST['password'],
                        $picture
                    );
            }
            $response = ['success01' => false];
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public static function Excerpt (string $string, int $limit = 15): ?string
    {
        if (mb_strlen($string) <= $limit) return $string;
        return mb_substr($string, 0, $limit) . '...';
    }

    public function displayUsers ()
    {
        $users = $this->userManager->getUsers();
        require "Views/users.php";
    }

    public static function addUser()
    {
        require "Views/addUser.php";
    }

    public function addUserValidate()
    {
        $uv = new UserValidator($_POST['name'], $_POST['mail'], $_POST['password']);
        $result = $uv->inputsContentValidate();
        $result = $uv->exists();
        $file = $_FILES['picture'];
        $directory = 'img/';
        $picture = $this->instanceOfHelpers($file, $directory)->addPicture();
        $this
            ->userManager
            ->insertUserIntoDatabase(
                $result[0],
                $result[1],
                $result[2],
                $picture
            );
        $_SESSION['alert'] = [
            'type' => 'success',
            'msg'  => 'L\'Utilisateur a été ajouté avec succès'
        ];
        header('Location: ' . URL . 'utilisateurs');
    }

    public function deleteUser($id)
    {
        $picture = $this->userManager->getUserById($id)->getPicture();
        if(file_exists(URL . 'img' . DIRECTORY_SEPARATOR . $picture)) unlink('img/'.$picture);
        $this->userManager->deleteUserOfDatabase($id);
        $_SESSION['alert'] = [
            'type' => 'success',
            'msg'  => 'L\'Utilisateur a été supprimé avec succès'
        ];
        header('Location: ' . URL . 'utilisateurs');
    }

    public function editUser($id)
    {
        $user = $this->userManager->getUserById($id);
        require "Views/editUser.php";
    }

    public function editUserValidate()
    {
        $uv = new UserValidator($_POST['name'], $_POST['mail'], $_POST['password']);
        $result = $uv->inputsContentValidate();
        $picture = $this->userManager->getUserById($_POST['user_id'])->getPicture();
        $file = $_FILES['picture'];
        if ($file['size'] > 0){
            $newPicture = $this->instanceOfHelpers($file, 'img/')->addPicture();
            if(file_exists(URL . 'img' . DIRECTORY_SEPARATOR . $picture)) unlink('img/'.$picture);
        }else{
            $newPicture = $picture;
        }
        $this
            ->userManager
            ->editUserIntoDatabase(
                $_POST['user_id'],
                $result[0],
                $result[1],
                $result[2],
                $newPicture
            );
        $_SESSION['alert'] = [
            'type' => 'success',
            'msg'  => 'L\'Utilisateur a été mofifié avec succès'
        ];
        header('Location: ' . URL . 'utilisateurs');
    }

}