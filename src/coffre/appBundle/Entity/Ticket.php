<?php

namespace coffre\appBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="coffre\appBundle\Entity\TicketRepository")
 */
class Ticket {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="NumTitre", type="integer")
     */
    private $numTitre;

    /**
     * @var integer
     *
     * @ORM\Column(name="Cryptage", type="integer")
     */
    private $cryptage;

    /**
     * @var integer
     *
     * @ORM\Column(name="valeur", type="integer")
     */
    private $valeur;

    /**
     * @var integer
     *
     * @ORM\Column(name="CleControle", type="integer")
     */
    private $cleControle;

    /**
     * @var integer
     *
     * @ORM\Column(name="Type", type="integer")
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="Operateur", type="integer")
     */
    private $operateur;

    /**
     * @var integer
     *
     * @ORM\Column(name="Session", type="integer")
     */
    private $session;
//    /**
//     * @ORM\ManyToOne(targetEntity="coffre\appBundle\Entity\Operateur",cascade={"persist"})
//     * @ORM\JoinColumn(nullable=false)
//     * 
//     */
//    private $operateur;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set numTitre
     *
     * @param integer $numTitre
     *
     * @return Ticket
     */
    public function setNumTitre($numTitre) {
        $this->numTitre = $numTitre;

        return $this;
    }

    /**
     * Get numTitre
     *
     * @return integer
     */
    public function getNumTitre() {
        return $this->numTitre;
    }

    /**
     * Set cryptage
     *
     * @param integer $cryptage
     *
     * @return Ticket
     */
    public function setCryptage($cryptage) {
        $this->cryptage = $cryptage;

        return $this;
    }

    /**
     * Get cryptage
     *
     * @return integer
     */
    public function getCryptage() {
        return $this->cryptage;
    }

    /**
     * Set valeur
     *
     * @param integer $valeur
     *
     * @return Ticket
     */
    public function setValeur($valeur) {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return integer
     */
    public function getValeur() {
        return $this->valeur;
    }

    /**
     * Set cleControle
     *
     * @param integer $cleControle
     *
     * @return Ticket
     */
    public function setCleControle($cleControle) {
        $this->cleControle = $cleControle;

        return $this;
    }

    /**
     * Get cleControle
     *
     * @return integer
     */
    public function getCleControle() {
        return $this->cleControle;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return Ticket
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType() {
        return $this->type;
    }


    /**
     * Set operateur
     *
     * @param integer $operateur
     *
     * @return Ticket
     */
    public function setOperateur($operateur)
    {
        $this->operateur = $operateur;

        return $this;
    }

    /**
     * Get operateur
     *
     * @return integer
     */
    public function getOperateur()
    {
        return $this->operateur;
    }

    /**
     * Set session
     *
     * @param integer $session
     *
     * @return Ticket
     */
    public function setSession($session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return integer
     */
    public function getSession()
    {
        return $this->session;
    }
}
