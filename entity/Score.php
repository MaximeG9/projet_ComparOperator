<?php

class Score
{
    private int $id;
    private int $value;
    private string $author;


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
     * Get the value of value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of value
     *
     * @return  self
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the value of author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @return  self
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }


    public function hydrate(array $datas)
    {

        if (isset($datas['id'])) {
            $this->setId($datas['id']);
        }

        if (isset($datas['value'])) {
            $this->setValue($datas['value']);
        }

        if (isset($datas['author_id'])) {
            $this->setAuthor($datas['author_id']);
        }
    }
}
