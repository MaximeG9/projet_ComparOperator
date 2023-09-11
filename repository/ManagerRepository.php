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

    public function getDestination ()
    {
        $sql = "SELECT * FROM destination";
        $request = $this->bdd->prepare($sql);
        $request->execute();

        $destinationsSelect = $request->fetchAll(PDO::FETCH_ASSOC);

        //var_dump($destinationsSelect);
        return $destinationsSelect;
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
                'id' => $destinationData['id'],
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

    public function getReviewbyOperatorId(int $id)
    {
        $query = "SELECT * FROM tour_operator
                LEFT JOIN review  
                ON review.tour_operator_id = tour_operator.id
                LEFT JOIN score  
                ON score.tour_operator_id = tour_operator.id
                WHERE id = :id";
        
        $result = $this->bdd->prepare($query);
        $result->execute([
            ':id' => $id
        ]);

        $allReviews = $result->fetchAll(PDO::FETCH_ASSOC);

        $reviews = [];
        $scores = [];

        foreach ($allReviews as $review) {
            $nReview = new Review($review);
            $reviews[] = $nReview; 

            $score = new Score($review);
            $scores[] = $score; 
        }

        $tourDatas = (isset($review))?$review:[];

        $to = new TourOperator($tourDatas, [], new Certificate([]));
        $to->setReviews($reviews);
        $to->setScores($scores);

        return $to;
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


    public function getAllDestinationForOneOperator(string $search): TourOperator | null //ce sont des specifications de la methode

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

        if (count($listLocation) > 0) { // on verifie qu'il y a des données dans $listLocation. S'il ya quelque chose on continue sinon on retourne null

            //var_dump($listLocation);

            $locations = []; // on stock les instances (new Destination) de destination


                        //on fait une boucle qui va remplir un tableau $locations ou nous allons préparer une instance de Destination dans laquelle nous allons set les propriéts id, location, price
            foreach ($listLocation as $location) {

                $locations[] = new Destination([
                    'id' => $location['id_location'],
                    'location' => $location['location'],
                    'price' => $location['price']
                ]);   
            } 
            // var_dump($locations);

            //on crée une instance de Certificate et on set avec tour_operator_id, expires_at et signatory. On utilise l'index 0 du tableau $listLocation.
            //On utilise l'indice 0 car on ne sait pas combien d'éléments il y a dans le tableau $listLocation mais on sait qu'il y en a au moins 1 grace au if (count)
            $certificate = new Certificate([
                'tour_operator_id' => $listLocation[0]['tour_operator_id'],
                'expires_at' => $listLocation[0]['expires_at'],
                'signatory' => $listLocation[0]['signatory']
            ]);

            // On crée une instance de TourOperator dans laquelle on insere les données d'un TO, la liste de nos destinations et le certificat du TO
            $operator = new TourOperator($listLocation[0], $locations, $certificate);
        
            return $operator;
        }

        return NULL;
    }

    public function updateOperatorToPremium()
    {
    }

    public function createTourOperator($name, $isPremium, $link):int
    {
        $sql = "INSERT INTO tour_operator (name, isPremium, link) VALUES (:name, :isPremium, :link)";
        $request = $this->bdd->prepare($sql);

        $isAdded = $request->execute([
            'name' => $name,
            'isPremium' => $isPremium,
            'link' => $link
        ]);

        if ($isAdded) return $this->bdd->lastInsertId();

        return -1;
    }

    public function createDestination($idTO, $destination, $price)
    {
        $sql = "INSERT INTO destination (location, price, tour_operator_id) VALUES (:location, :price, :id_to)";
        $request = $this->bdd->prepare($sql);

        return $request->execute([
            ':location' => $destination,
            ':price' => $price,
            ':id_to' => $idTO
        ]);
    }

    public function createCertificate($idTO, $signatory, $expiresAt)
    {
        $sql = "INSERT INTO certificate (expires_at, signatory, tour_operator_id) VALUES (:expires, :signatory, :id_to)";
        $request = $this->bdd->prepare($sql);

        return $request->execute([
            ':expires' => date('Y-m-d', strtotime($expiresAt)),
            ':signatory' => $signatory,
            ':id_to' => $idTO
        ]);
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


    public function getReviewAndScoresOperator(string $search): TourOperator | null //ce sont des specifications de la methode

    {
        $sql = 'SELECT * FROM tour_operator               
                INNER JOIN `review` 
                ON review.tour_operator_id = tour_operator.id
                INNER JOIN `score`
                ON tour_operator.id = score.tour_operator_id
                WHERE `id` = :id
                GROUP BY message;';

        $request = $this->getBdd()->prepare($sql);
        $request->execute([
            'id' => $search,
        ]);


        $listReviewsScores = $request->fetchAll(PDO::FETCH_ASSOC);

        if (count($listReviewsScores) > 0) { // on verifie qu'il y a des données dans $listReviewsScores. S'il ya quelque chose on continue sinon on retourne null

            //var_dump($listReviewsScores);

            $reviews = []; // on stock les instances (new Destination) de destination
            $scores = [];


                        //on fait une boucle qui va remplir un tableau $locations ou nous allons préparer une instance de Destination dans laquelle nous allons set les propriéts id, location, price
            foreach ($listReviewsScores as $scorev) {

                $reviews[] = new Review([
                    'id' => $scorev['id_review'],
                    'message' => $scorev['message']
                ]);
                
                $scores[] = new Score([
                    'id' => $scorev['id_score'],
                    'value' => $scorev['value']
                ]);   
            } 
            // var_dump($locations);

            //on crée une instance de Certificate et on set avec tour_operator_id, expires_at et signatory. On utilise l'index 0 du tableau $listReviewScore.
            //On utilise l'indice 0 car on ne sait pas combien d'éléments il y a dans le tableau $listReviewScore mais on sait qu'il y en a au moins 1 grace au if (count)
            // On crée une instance de TourOperator dans laquelle on insere les données d'un TO, la liste de nos destinations et le certificat du TO
            $operator = new TourOperator($listReviewsScores[0], [], new Certificate([])); // on met un tableau vide et on crée un certificat vide car il  faut quand meme mettre ces arguments dans la fonction car on ne va pas se servir de ces propriétés
            $operator->setReviews($reviews);
            $operator->setScores($scores);
            var_dump($operator->getDestinations()[1]->getPrice());
        
            return $operator;
        }

        return NULL;
    }
}
