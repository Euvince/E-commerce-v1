<?php

namespace Models;

class User 
{
    private $id;

    private $user_name;

    private $mail;

    private $password;

    private $picture;


    public function __construct($id, $user_name, $mail, $password, $picture)
    {
        $this->id = $id;

        $this->user_name = $user_name;

        $this->mail = $mail;

        $this->password = $password;

        $this->picture = $picture;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of user_name
     */ 
    public function getUsername(): ?string
    {
        return $this->user_name;
    }

    /**
     * Set the value of user_name
     *
     * @return  self
     */ 
    public function setUsername($user_name): ?self
    {
        $this->user_name = $user_name;

        return $this;
    }

    /**
     * Get the value of mail
     */ 
    public function getMail(): ?string
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function setMail($mail): ?self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password): ?self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of picture
     */ 
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @return  self
     */ 
    public function setPicture($picture): ?self
    {
        $this->picture = $picture;

        return $this;
    }

}