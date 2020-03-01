<?php

namespace AffectationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Demande
 *
 * @ORM\Table(name="demande")
 * @ORM\Entity(repositoryClass="AffectationBundle\Repository\DemandeRepository")
 */
class Demande
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
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255)
     * @Assert\NotBlank(message="Champ Obligatoire")
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="cas", type="string", length=255)
     * @Assert\NotBlank(message="Champ Obligatoire")
     */
    private $cas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     * @Assert\Date(message="Veuillez inserer une date valide")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity="Equipment", mappedBy="demande")
     *@Assert\NotBlank(message="Champs Obligatoires")
     */
    private $equipements;

    /**
     * @ORM\OneToMany(targetEntity="Service", mappedBy="demande")
     * @Assert\NotBlank(message="Champs Obligatoires")
     */
    private $services;

    /**
     * @ORM\OneToMany(targetEntity="Argent", mappedBy="demande")
     * @Assert\NotBlank(message="Champs Obligatoires")
     */
    private $argents;

    /**
     * Demande constructor.
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
     * @return Demande
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
     * Set etat
     *
     * @param string $etat
     *
     * @return Demande
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set cas
     *
     * @param string $cas
     *
     * @return Demande
     */
    public function setCas($cas)
    {
        $this->cas = $cas;

        return $this;
    }

    /**
     * Get cas
     *
     * @return string
     */
    public function getCas()
    {
        return $this->cas;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Demande
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
}

