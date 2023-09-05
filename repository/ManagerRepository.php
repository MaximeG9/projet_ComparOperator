<?php

class ManagerRepository
{
    private PDO $bdd;

    public function __construct(PDO $bdd)
    {
        $this->setBdd($bdd);
    }

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

    public function getAllDestination()
    {}

    public function getOperatorByDestination()
    {}

    public function createReview()
    {}

    public function getReviewbyOperatorId()
    {}

    public function getAllOperator(string $search = ''):array
    {
        $operators = [];
        $sql = 'SELECT * FROM tour_operator ORDER BY isPremium;';

        $request = $this->getBdd()->query($sql);
        $allOperators = $request->fetchAll(PDO:FETCH_ASSOC);

        foreach ($allOperators as $operator) {
            $operators[] = new TourOperator($operator);
        }

        return $operators;
    }

    public function updateOperatorToPremium()
    {}

    public function createTourOperator()
    {}

    public function createDestination()
    {}

}
