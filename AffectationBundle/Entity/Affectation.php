<?php

namespace AffectationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Affectation
 *
 * @ORM\Table(name="affectation")
 * @ORM\Entity(repositoryClass="AffectationBundle\Repository\AffectationRepository")
 */
class Affectation
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
     * @ORM\Column(name="remarque", type="string", length=255)
     * @Assert\NotBlank(message="Champ Obligatoire")
     */
    private $remarque;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     * @Assert\Date(message="Veuillez inserer une date valide")
     */
    private $date;


    /**
     * @ORM\OneToMany(targetEntity="Equipment", mappedBy="affectation")
     * @Assert\NotBlank(message="Champs Obligatoires")
     */
    private $equipements;

    /**
     * @ORM\OneToMany(targetEntity="Service", mappedBy="affectation")
     * @Assert\NotBlank(message="Champs Obligatoires")
     */
    private $services;

    /**
     * @ORM\OneToMany(targetEntity="Argent", mappedBy="affectation")
     * @Assert\NotBlank(message="Champs Obligatoires")
     */
    private $argents;

    /**
     * Affectation constructor.
     */
    public function __construct()
    {
        $this->equipements = new ArrayCollection();
        $this->services = new ArrayCollection();
        $this->argents = new ArrayCollection();
    }




    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set remarque
     *
     * @param string $remarque
     *
     * @return Affectation
     */
    public function setRemarque($remarque)
    {
        $this->remarque = $remarque;

        return $this;
    }

    /**
     * Get remarque
     *
     * @return string
     */
    public function getRemarque()
    {
        return $this->remarque;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Affectation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return ArrayCollection
     */
    public function getEquipements()
    {
        return $this->equipements;
    }

    /**
     * @param ArrayCollection $equipements
     */
    public function setEquipements($equipements)
    {
        $this->equipements = $equipements;
    }

    /**
     * @return ArrayCollection
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @param ArrayCollection $services
     */
    public function setServices($services)
    {
        $this->services = $services;
    }

    /**
     * @return ArrayCollection
     */
    public function getArgents()
    {
        return $this->argents;
    }

    /**
     * @param ArrayCollection $argents
     */
    public function setArgents($argents)
    {
        $this->argents = $argents;
    }


}

