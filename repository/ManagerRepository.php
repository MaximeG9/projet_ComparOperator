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
        $sql = "SELECT * FROM destination 
                INNER JOIN tour_operator ON  = destination.tour_operator_id = tour_operator.id";
        $request = $this->bdd->prepare($sql);
        $request->execute();

        $allDestinations = $request->fetchAll(PDO::FETCH_ASSOC);

        $destinations = [];

        foreach ($allDestinations as $destination) {
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
                LEFT JOIN `score` 
                ON score.tour_operator_id = tour_operator.id 
                WHERE `location` 
                LIKE ?
                GROUP BY `name`";

        $result = $this->bdd->prepare($query);
        $result->execute([
            "%" . addslashes($destination) . "%"
        ]);
        $destinationDatas = $result->fetchAll(PDO::FETCH_ASSOC);
        $tourOperators = [];



        foreach ($destinationDatas as $destinationData) {
            $destinations = [];
            $destinations[] = new Destination([
                'id' => $destinationData['id_location'],
                'location' => $destinationData['location'],
                'price' => $destinationData['price']
            ]);

            $tourOperators[] = new TourOperator([
                'id' => $destinationData['tour_operator_id'],
                'name' => $destinationData['name'],
                'isPremium' => $destinationData['isPremium'],
                'link' => $destinationData['link']
            ], $destinations);
        }


        return $tourOperators;
    }

    public function createReview()
    {
        $sql = "INSERT INTO review (message) VALUES (:message) ";
        $request = $this->bdd->prepare($sql);
        $request->execute([]);
    }

    public function getReviewbyOperatorId()
    {
    }

    public function getAllOperator($search): array
    {
        $operators = [];
        $sql = 'SELECT * FROM tour_operator ORDER BY isPremium;';

        $request = $this->getBdd()->query($sql);
        $allOperators = $request->fetchAll(PDO::FETCH_ASSOC);

        foreach ($allOperators as $operator) {
            if ($operator['isPremium'] == null) $operator['isPremium'] = false;

            $operators[] = new TourOperator($operator, []);
        }

        return $operators;
    }

    public function getAllDestinationForOneOperator($search): TourOperator
    {
        $sql = 'SELECT * FROM  destination                
                INNER JOIN `tour_operator` 
                ON destination.tour_operator_id = tour_operator.id
                WHERE `id` = :id;';

        $request = $this->getBdd()->prepare($sql);
        $request->execute([
            'id' => $search,
        ]);

        $listLocation = $request->fetchAll(PDO::FETCH_ASSOC);
        var_dump($listLocation);

        $locations = [];

        foreach ($listLocation as $location) {

            $locations[] = new Destination([
                'id' => $location['id_location'],
                'location' => $location['location'],
                'price' => $location['price']
            ]);
        }

        $operator = new TourOperator($listLocation[0], $locations);

        return $operator;
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
