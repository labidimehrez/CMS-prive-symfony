<?php

namespace MyApp\EspritBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity
 */
class Utilisateur {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

     

    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="utilisateurs")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id",nullable=false)
     */
    protected $role;

  
    /**
     * @ORM\OneToMany(targetEntity="Menu", mappedBy="utilisateur")
     */
    protected $menus;

    /**
     * @ORM\OneToMany(targetEntity="Actualite", mappedBy="utilisateur")
     */
    protected $actualites;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255,unique=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255,unique=true)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255,unique=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255,unique=true)
     */
    private $mail;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Utilisateur
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set login
     *
     * @param string $login
     * @return Utilisateur
     */
    public function setLogin($login) {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin() {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Utilisateur
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Utilisateur
     */
    public function setMail($mail) {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail() {
        return $this->mail;
    }

      public function getMenus() {
        return $this->menus;
    }

    public function getActualites() {
        return $this->actualites;
    }

    public function setMenus($menus) {
        $this->menus = $menus;
    }

    public function setActualites($actualites) {
        $this->actualites = $actualites;
    }

    
    
    public function __toString() {
        return $this->id .'';
    }

}
