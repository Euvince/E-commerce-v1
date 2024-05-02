<?php

namespace Models;

use Controllers\GeneralController;
use DateTime;

class Refreshment
{
    private $id;

    private $title;

    private $content;

    private $picture;

    private $price;

    private $created_at;

    public function __construct($id, $title, $content, $price, $picture, $created_at = null)
    {
        $this->id = $id;

        $this->title = $title;

        $this->content = $content;

        $this->price = $price;

        $this->picture = $picture;

        $this->created_at = $created_at;
    }

    /**
     * Get the value of id
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id): ?int
    {
        return $this->id = $id;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title): ?string
    {
        return $this->title = $title;
    }

    /**
     * Get the value of content
     */ 
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content): ?string
    {
        return $this->content = $content;
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
    public function setPicture($picture): ?string
    {
        return $this->picture = $picture;  
    }

    /**
     * Get the value of price
     */ 
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreatedAt(): ?DateTime
    {
        return new DateTime($this->created_at);
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }
}