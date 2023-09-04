<?php

class Certificate
{
    private datetime $expiresAt;
    private string $signatory;


    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

    /**
     * Get the value of expiresAt
     */ 
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Set the value of expiresAt
     *
     * @return  self
     */ 
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * Get the value of signatory
     */ 
    public function getSignatory()
    {
        return $this->signatory;
    }

    /**
     * Set the value of signatory
     *
     * @return  self
     */ 
    public function setSignatory($signatory)
    {
        $this->signatory = $signatory;

        return $this;
    }


    public function hydrate(array $datas)
    {

        if (isset($datas['expires_at'])) {
            $this->setExpiresAt($datas['expire_at']);
        }

        if (isset($datas['signatory'])) {
            $this->setSignatory($datas['signatory']);
        }
    }
}