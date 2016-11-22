<?php

namespace TicketsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="TicketsBundle\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="compteFacture", type="string", length=255, nullable=true)
     */
    private $compteFacture;

    /**
     * @var string
     *
     * @ORM\Column(name="numFacture", type="string", length=255, nullable=true)
     */
    private $numFacture;

    /**
     * @var string
     *
     * @ORM\Column(name="numAbonne", type="string", length=255, nullable=true)
     */
    private $numAbonne;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=255, nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="heure", type="string", length=255, nullable=true)
     */
    private $heure;

    /**
     * @var string
     *
     * @ORM\Column(name="dureeReel", type="string", length=255, nullable=true)
     */
    private $dureeReel;

    /**
     * @var string
     *
     * @ORM\Column(name="dureeFacture", type="string", length=255, nullable=true)
     */
    private $dureeFacture;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set compteFacture
     *
     * @param string $compteFacture
     * @return Ticket
     */
    public function setCompteFacture($compteFacture)
    {
        $this->compteFacture = $compteFacture;

        return $this;
    }

    /**
     * Get compteFacture
     *
     * @return string 
     */
    public function getCompteFacture()
    {
        return $this->compteFacture;
    }

    /**
     * Set numFacture
     *
     * @param string $numFacture
     * @return Ticket
     */
    public function setNumFacture($numFacture)
    {
        $this->numFacture = $numFacture;

        return $this;
    }

    /**
     * Get numFacture
     *
     * @return string 
     */
    public function getNumFacture()
    {
        return $this->numFacture;
    }

    /**
     * Set numAbonne
     *
     * @param string $numAbonne
     * @return Ticket
     */
    public function setNumAbonne($numAbonne)
    {
        $this->numAbonne = $numAbonne;

        return $this;
    }

    /**
     * Get numAbonne
     *
     * @return string 
     */
    public function getNumAbonne()
    {
        return $this->numAbonne;
    }

    /**
     * Set date
     *
     * @param string $date
     * @return Ticket
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set heure
     *
     * @param string $heure
     * @return Ticket
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;

        return $this;
    }

    /**
     * Get heure
     *
     * @return string 
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * Set dureeReel
     *
     * @param string $dureeReel
     * @return Ticket
     */
    public function setDureeReel($dureeReel)
    {
        $this->dureeReel = $dureeReel;

        return $this;
    }

    /**
     * Get dureeReel
     *
     * @return string 
     */
    public function getDureeReel()
    {
        return $this->dureeReel;
    }

    /**
     * Set dureeFacture
     *
     * @param string $dureeFacture
     * @return Ticket
     */
    public function setDureeFacture($dureeFacture)
    {
        $this->dureeFacture = $dureeFacture;

        return $this;
    }

    /**
     * Get dureeFacture
     *
     * @return string 
     */
    public function getDureeFacture()
    {
        return $this->dureeFacture;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Ticket
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }
}
