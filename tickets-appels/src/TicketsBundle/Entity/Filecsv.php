<?php

namespace TicketsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Filecsv
 *
 * @ORM\Table(name="filecsv")
 * @ORM\Entity(repositoryClass="TicketsBundle\Repository\FilecsvRepository")
 */
class Filecsv
{
    /**
     *
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     *
     * @ORM\Column(name="csvFile", type="string")
     * @Assert\NotBlank(message="Please, upload the file as a csv file.")
     * @Assert\File(mimeTypes={ "text/plain" })
     */
    private $csvFile;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }


    public function setCsvFile($csvFile)
    {
        $this->csvFile = $csvFile;

        return $this;
    }


    public function getCsvFile()
    {
        return $this->csvFile;
    }
}
