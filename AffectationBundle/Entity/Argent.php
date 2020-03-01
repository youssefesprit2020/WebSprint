<?php

namespace AffectationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Argent
 *
 * @ORM\Table(name="argent")
 * @ORM\Entity(repositoryClass="AffectationBundle\Repository\ArgentRepository")
 */
class Argent
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
     * @var float
     *
     * @ORM\Column(name="montant", type="float")
     */
    private $montant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Demande", inversedBy="argents")
     */
    private $demande;

    /**
     * @ORM\ManyToOne(targetEntity="Affectation", inversedBy="argents")
     */
    private $affectation;

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
     * Set montant
     *
     * @param float $montant
     *
     * @return Argent
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Argent
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
     * @return mixed
     */
    public function getDemande()
    {
        return $this->demande;
    }

    /**
     * @param mixed $demande
     */
    public function setDemande($demande)
    {
        $this->demande = $demande;
    }

    /**
     * @return mixed
     */
    public function getAffectation()
    {
        return $this->affectation;
    }

    /**
     * @param mixed $affectation
     */
    public function setAffectation($affectation)
    {
        $this->affectation = $affectation;
    }


}

