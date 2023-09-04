<?php

class ManagerRepository
{
    private PDO $bdd;

    public function __construct(PDO $bdd)
    {
        $this->setBdd($bdd);
    }

    public function getAllDestination()
    {}

    public function getOperatorByDestination()
    {}

    public function createReview()
    {}

    public function getReviewbyOperatorId()
    {}

    public function getAllOperator()
    {}

    public function updateOperatorToPremium()
    {}

    public function createTourOperator()
    {}

    public function createDestination()
    {}



    /**
     * Get the value of bdd
     */ 
    public function getBdd()
    {
        return $this->bdd;
    }

    /**
     * Set the value of bdd
     *
     * @return  self
     */ 
    public function setBdd($bdd)
    {
        $this->bdd = $bdd;

        return $this;
    }
}