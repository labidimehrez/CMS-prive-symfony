<?php

namespace MyApp\EspritBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Menu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
   
    protected $rubriques;
  

    /**
     * @ORM\ManyToOne(targetEntity="Utilisateur", inversedBy="menus")
     * @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id",nullable=false)
     */
 
   protected $utilisateur;
    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer",unique=true)
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255,unique=true)
     */
    private $title;


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
     * Set position
     *
     * @param integer $position
     * @return Menu
     */
    public function setPosition($position)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Menu
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
        public function getRubriques() {
        return $this->rubriques;
    }

    public function setRubriques($rubriques) {
        $this->rubriques = $rubriques;
    }
      public function getUtilisateur() {
        return $this->utilisateur;
    }

    public function setUtilisateur($utilisateur) {
        $this->utilisateur = $utilisateur;
    }
    
      public function __toString()
    {
          return $this->nom.'' ;
    }
    
}
