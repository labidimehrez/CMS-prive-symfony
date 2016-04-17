<?php

namespace MyApp\EspritBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SousRubrique
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class SousRubrique {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="MyApp\EspritBundle\Entity\Rubrique")
     * @ORM\JoinColumn(name="rubrique_id", referencedColumnName="id",nullable=false, onDelete="CASCADE")
     */
    protected $rubrique;

    
    protected $article;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @var boolean
     *
     * @ORM\Column(name="state", type="boolean")
     */
    private $state;

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
    public function getId() {
        return $this->id;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return SousRubrique
     */
    public function setPosition($position) {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition() {
        return $this->position;
    }

    /**
     * Set state
     *
     * @param boolean $state
     * @return SousRubrique
     */
    public function setState($state) {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return boolean 
     */
    public function getState() {
        return $this->state;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return SousRubrique
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    public function getRubrique() {
        return $this->rubrique;
    }

    public function setRubrique($rubrique) {
        $this->rubrique = $rubrique;
    }

    public function getArticle() {
        return $this->article;
    }

    public function setArticle($article) {
        $this->article = $article;
    }

    public function __toString() {
        return $this->title . '';
    }

}
