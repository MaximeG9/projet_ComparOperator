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
    { 
        $sql = "SELECT * FROM destination";
        $request = $this->bdd->prepare($sql);
        $request->execute();

        $allDestinations = $request->fetchAll(PDO::FETCH_ASSOC);

        $destinatons = [];

        foreach ($allDestinations as $destination) {
            $destination = new Destination($destinations);
        }

        return $destinaton;
    }

    public function getOperatorsByDestination(string $destination)
    {
        $query = "SELECT * FROM `destination` 
                INNER JOIN `tour_operator` 
                ON destination.tour_operator_id = tour_operator.id 
                WHERE `location` 
                LIKE ?";

        $result = $this->bdd->prepare($query);
        $result->execute([
            "%". addslashes($destination) . "%"
        ]);
        $destinationDatas = $result->fetchAll(PDO::FETCH_ASSOC);
        $tourOperators = [];

        $destinations = [];
        $destinations[] = new Destination([
            'id' => $destinationDatas[0]['id'],
            'location' =>$destinationDatas[0]['location'],
            'price' =>$destinationDatas[0]['price']
        ]);

        foreach ($destinationDatas as $destinationData) {
            $tourOperators[] = new TourOperator([
                'id' =>$destinationData['tour_operator_id'],
                'name' =>$destinationData['name'],
                'isPremium' =>$destinationData['isPremium'],
                'link' =>$destinationData['link']
            ], $destinations);

        }

       
        return $tourOperators;

        
    }

    public function createReview()
    {
        $sql = "INSERT INTO review (message) VALUES (:message) ";
        $request = $this->bdd->prepare($sql);
        $request->execute([

        ])

    }

    public function getReviewbyOperatorId()
    {
    }

    public function getAllOperator():array
    {
        $operators = [];
        $sql = 'SELECT * FROM tour_operator ORDER BY isPremium;';

        $request = $this->getBdd()->query($sql);
        $allOperators = $request->fetchAll(PDO::FETCH_ASSOC);

        foreach ($allOperators as $operator) {
            if ($operator['isPremium'] == null) $operator['isPremium'] = false;

            $operators[] = new TourOperator($operator);
        }

        return $operators;
 
    }

    public function updateOperatorToPremium()
    {

    }

    public function createTourOperator()
    { 
        $sql = "INSERT INTO tour_operator (name, isPremium, link) VALUES (:name, :isPremium, :link)";
        $request = $this->bdd->prepare($sql);
        $request->execute([
            'name' => $_POST['name'],
            'isPremium' => $_POST['isPremium'],
            'link' => $_POST['link']
        ]);

        header('Location: ./add-tour.php');
        
    }

    public function createDestination()
    {
    }

}
