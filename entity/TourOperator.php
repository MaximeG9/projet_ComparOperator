<?php

class TourOperator 
{
    private int $id;
    private string $name;
    private string $link;
    private $certificate;
    private array $destinations;
    private array $reviews; 
    private array $scores;
    private bool $isPremium;


    public function __construct(array $datas)
    {
        $this->hydrate($datas);
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
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of destinations
     */ 
    public function getDestinations()
    {
        return $this->destinations;
    }

    /**
     * Set the value of destinations
     *
     * @return  self
     */ 
    public function setDestinations($destinations)
    {
        $this->destinations = $destinations;

        return $this;
    }

    /**
     * Get the value of link
     */ 
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set the value of link
     *
     * @return  self
     */ 
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get the value of reviews
     */ 
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * Set the value of reviews
     *
     * @return  self
     */ 
    public function setReviews($reviews)
    {
        $this->reviews = $reviews;

        return $this;
    }

    /**
     * Get the value of scores
     */ 
    public function getScores()
    {
        return $this->scores;
    }

    /**
     * Set the value of scores
     *
     * @return  self
     */ 
    public function setScores($scores)
    {
        $this->scores = $scores;

        return $this;
    }

    /**
     * Get the value of certificate
     */ 
    public function getCertificate()
    {
        return $this->certificate;
    }

    /**
     * Set the value of certificate
     *
     * @return  self
     */ 
    public function setCertificate($certificate)
    {
        $this->certificate = $certificate;

        return $this;
    }

    /**
     * Get the value of isPremium
     */ 
    public function getIsPremium()
    {
        return $this->isPremium;
    }

    /**
     * Set the value of isPremium
     *
     * @return  self
     */ 
    public function setIsPremium($isPremium)
    {
        $this->isPremium = $isPremium;

        return $this;
    }

    public function hydrate (array $datas)
    {
    
    if (isset($datas['id'])){
     $this->setId($datas['id']);
    }

    if (isset($datas['name'])){
     $this->setName($datas['name']);
    }

    if (isset($datas['isPremium'])){
     $this->setIsPremium($datas['isPremium']);
    }

    if (isset($datas['link'])){
     $this->setLink($datas['link']);
    }

    }
}
