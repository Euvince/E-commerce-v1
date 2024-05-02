<?php

namespace Controllers;

use Helpers\Helpers;
use Validators\ElementValidator;

class GeneralController
{
    private $file;
    private $directory; 
    private $title; 
    private $content;
    private $price;
    private $id;
    
    public function __construct(
        ?array $file = null, 
        ?string $directory = null, 
        ?string $title = null, 
        ?string $content = null, 
        $price = null,
        ?int $id = null
    )
    {
        $this->file = $file;
        $this->directory = $directory;
        $this->title = $title;
        $this->content = $content;
        $this->price = $price;
        $this->id = $id;
    }

    public static function instanceOfHelpers (
        $file, 
        string $directory
    ): Helpers
    {
        return new Helpers($file, $directory);
    }

    public static function instanceOfElementValidator (
        string $title, 
        string $content,
        $price
    ): ElementValidator
    {
        return new ElementValidator($title, $content, $price);
    }

    public static function Excerpt (string $string, int $limit = 45): ?string
    {
        if (mb_strlen($string) <= $limit) return $string;
        return mb_substr($string, 0, $limit) . '...';
    }

    public static function FormattedTitle(string $title, int $limit = 12): ?string
    {
        if (mb_strlen($title) <= $limit) return $title;
        return mb_substr($title, 0, $limit) . '...';
    }

    public static function alertMsg (
        string $word1 , 
        string $word2, 
        string $word3): array
    {
        $_SESSION['alert'] = [
            'type' => 'success',
            'msg' => "{$word1} du {$word2} {$word3} avec succès"
        ];
        return $_SESSION['alert'];
    }

    public function addElementValidate(
        $manager, 
        string $insertElementManager, 
        string $word1, 
        string $word2, 
        string $word3
    )
    {
        $result = $this->instanceOfElementValidator(
            $this->title, 
            $this->content,
            $this->price
        )->inputsContentValidate();
        $pictureName = $this->instanceOfHelpers(
            $this->file, 
            $this->directory
        )->addPicture();
        $manager->{$insertElementManager}($result[0], $result[1], $result[2], $pictureName);
        $this->alertMsg($word1, $word2, $word3);
    }

    public function editElementValidate (
        string $currentPicture, 
        $manager, 
        $editElementManager, 
        string $word1, 
        string $word2, 
        $word3
    )
    {
        if ($this->file['size'] > 0)
        {
            $this->directory = 'img/';
            $pictureNameEdit = $this->instanceOfHelpers(
                $this->file, 
                $this->directory
            )->addPicture();
            if(file_exists(URL . 'img' . DIRECTORY_SEPARATOR . $currentPicture)) unlink('img/'.$currentPicture);
            /* unlink('img/'.$currentPicture); */
        }
        else 
        {
            $pictureNameEdit = $currentPicture;
        }
        $result = $this->instanceOfElementValidator(
            $this->title, 
            $this->content,
            $this->price
        )->inputsContentValidate();
        $manager->{$editElementManager}(
            $this->id, 
            $result[0], 
            $result[1], 
            $result[2],
            $pictureNameEdit
        );
        $this->alertMsg($word1, $word2, $word3);
    }

}