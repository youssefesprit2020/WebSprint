<?php

namespace AffectationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipment
 *
 * @ORM\Table(name="equipment")
 * @ORM\Entity(repositoryClass="AffectationBundle\Repository\EquipmentRepository")
 */
class Equipment
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255)
     */
    private $etat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Demande", inversedBy="equipements")
     */
    private $demande;

    /**
     * @ORM\ManyToOne(targetEntity="Affectation", inversedBy="equipements")
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Equipment
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Equipment
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Equipment
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

