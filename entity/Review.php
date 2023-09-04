<?php

class Review
{
    private int $id;
    private string $message;
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
     * Get the value of message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */
    public function setMessage($message)
    {
        $this->message = $message;

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

        if (isset($datas['message'])) {
            $this->setMessage($datas['message']);
        }

        if (isset($datas['author_id'])) {
            $this->setAuthor($datas['author_id']);
        }
    }
}
