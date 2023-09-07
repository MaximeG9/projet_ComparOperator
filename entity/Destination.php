<?php

class Destination
{
    private int $id;
    private string $location;
    private int $price;


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
     * Get the value of location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of location
     *
     * @return  self
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }


    public function hydrate(array $datas)
    {

        if (isset($datas['id'])) {
            $this->setId($datas['id']);
        }

        if (isset($datas['location'])) {
            $this->setLocation($datas['location']);
        }

        if (isset($datas['price'])) {
            $this->setPrice($datas['price']);
        }
    }
}
