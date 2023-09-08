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
                INNER JOIN tour_operator ON destination.tour_operator_id = tour_operator.id";
        $request = $this->bdd->prepare($sql);
        $request->execute();

        $allDestinations = $request->fetchAll(PDO::FETCH_ASSOC);

        $destinations = [];

        foreach ($allDestinations as $destination) {
            $destination = new Destination($destination);
            $destinations[] = $destination;
        }

        return $destinations;
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
            ], $destinations, new Certificate([]));
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
        $query = "SELECT * FROM tour_operator
                INNER JOIN review  
                ON review.tour_operator_id = tour_operator.id
                WHERE tour_operator_id = id";

        $result = $this->bdd->prepare($query);
        $result->execute();

        $allReviews = $result->fetchAll(PDO::FETCH_ASSOC);

        $reviews = [];

        foreach ($allReviews as $review) {
            $review = new Review($review);
            $reviews[] = $review;
        }

        return $reviews;
    }

    public function getScorebyAuthorId()
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

            $operators[] = new TourOperator($operator, [], new Certificate([]));
        }

        return $operators;
    }


    public function getAllDestinationForOneOperator(string $search): TourOperator | null //ce sont des specifications de la

    {
        $sql = 'SELECT * FROM tour_operator               
                INNER JOIN `destination` 
                ON destination.tour_operator_id = tour_operator.id
                INNER JOIN `certificate`
                ON tour_operator.id = certificate.tour_operator_id
                WHERE `id` = :id;';

        $request = $this->getBdd()->prepare($sql);
        $request->execute([
            'id' => $search,
        ]);


        $listLocation = $request->fetchAll(PDO::FETCH_ASSOC);

        if (count($listLocation) > 0) {

            // var_dump($listLocation);

            $locations = [];

            foreach ($listLocation as $location) {

                $locations[] = new Destination([
                    'id' => $location['id_location'],
                    'location' => $location['location'],
                    'price' => $location['price']
                ]);
            }

            $certificate = new Certificate([
                'tour_operator_id' => $listLocation[0]['tour_operator_id'],
                'expires_at' => $listLocation[0]['expires_at'],
                'signatory' => $listLocation[0]['signatory']
            ]);

            $operator = new TourOperator($listLocation[0], $locations, $certificate);

            return $operator;
        }

        return NULL;
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

    public function modifyDestination($id, $location, $price)
    {
        $sql = "UPDATE destination 
                    SET location = :location, price = :price
                    WHERE id_location = :id";
        $request = $this->bdd->prepare($sql);
        $request->execute([
            'location' => $location,
            'price' => $price,
            'id' => $id
        ]);
    }

    public function deleteLocation($id)
    {
        $sql = "DELETE FROM destination WHERE id_location = :id";
        $request = $this->bdd->prepare($sql);
        $request->execute([
            'id' => $id
        ]);
    }


    public function selectTourWithReviews()
    {
        $query = "SELECT id, name, isPremium, link, review.id_review, review.message, review.tour_operator_id
                FROM tour_operator
                JOIN review
                ON tour_operator.id = review.tour_operator_id";
        $result = $this->bdd->prepare($query);
        $result->execute();
        $reviews = $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectReviews()
    {
        $query = "SELECT
        id_review,
        message,
        tour_operator_id
        FROM
        review
        WHERE
        tour_operator_id = $id";
        $result = $this->$bdd->prepare($query);
        $result->execute(["id" => $id]);
        $reviews = $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
