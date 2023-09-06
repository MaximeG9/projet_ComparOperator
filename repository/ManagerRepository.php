<?php

class ManagerRepository
{
    private PDO $bdd;

    public function __construct(PDO $bdd)
    {
        $this->setBdd($bdd);
    }

    public function getAllDestination()
    { 
        $sql = "SELECT * FROM destination 
                INNER JOIN tour_operator 
                ON destination.tour_operator_id = tour_operator.id";
        $request = $this->bdd->prepare($sql);
        $request->execute();

        $allDestinations = $request->fetchAll(PDO::FETCH_ASSOC);

        $destinations = [];

        foreach ($allDestinations as $destination) {
            $nameLocation = $destination['name'];
            $destination = new Destination($destination);
            $destinations[] = $destination;
        }

        return $destination;
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
    }

    public function getReviewbyOperatorId()
    {
    }

    public function getAllOperator()
    {
    }

    public function updateOperatorToPremium()
    {
    }

    public function createTourOperator()
    {
    }

    public function createDestination()
    {
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
}
