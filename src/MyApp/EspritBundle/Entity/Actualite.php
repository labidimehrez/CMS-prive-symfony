<?php

namespace MyApp\EspritBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actualite
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Actualite {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

  

    /**
     * @ORM\ManyToOne(targetEntity="Utilisateur", inversedBy="actualites")
     * @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id",nullable=false)
     */
    protected $utilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255,unique=true)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateinsertion", type="date")
     */
    private $dateinsertion;

    public function __construct() {
        $this->dateinsertion = new \Datetime();
    }

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255,nullable=true)
     */
    private $image;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Actualite
     */
    public function setTitre($titre) {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre() {
        return $this->titre;
    }

    /**
     * Set dateinsertion
     *
     * @param \DateTime $dateinsertion
     * @return Actualite
     */
    public function setDateinsertion($dateinsertion) {
        $this->dateinsertion = $dateinsertion;

        return $this;
    }

    /**
     * Get dateinsertion
     *
     * @return \DateTime 
     */
    public function getDateinsertion() {
        return $this->dateinsertion;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Actualite
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Actualite
     */
    public function setImage($image) {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage() {
        return $this->image;
    }
    public function getUtilisateur() {
        return $this->utilisateur;
    }

    public function setUtilisateur($utilisateur) {
        $this->utilisateur = $utilisateur;
    }
    public function __toString() {
        return $this->id.''.$this->nom;
    }

}
