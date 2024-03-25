<?php

namespace App\Entity;

/**
 * Classe permettant de générer le formulaire de selection de ville et date
 */
class ApiForm
{

    private ?int $id = null;

    private ?string $ville = null;

    private ?\DateTime $date = null;
    
    /**
     * Method getId
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    
    /**
     * Method getVille
     *
     * @return string
     */
    public function getVille(): ?string
    {
        return $this->ville;
    }
    
    /**
     * Method setVille
     *
     * @param string $ville
     *
     * @return static
     */
    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }
    
    /**
     * Method getDate
     *
     * @return DateTime
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }
    
    /**
     * Method setDate
     *
     * @param \DateTime $date
     *
     * @return static
     */
    public function setDate(\DateTime $date): static
    {
        $this->date = $date;

        return $this;
    }
}
