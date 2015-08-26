<?php

namespace coffre\appBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Operateur
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="coffre\appBundle\Entity\OperateurRepository")
 */
class Operateur
{
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
     * @ORM\Column(name="Numop", type="integer")
     */
    private $numop;


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
     * Set numop
     *
     * @param integer $numop
     *
     * @return Operateur
     */
    public function setNumop($numop)
    {
        $this->numop = $numop;

        return $this;
    }

    /**
     * Get numop
     *
     * @return integer
     */
    public function getNumop()
    {
        return $this->numop;
    }
}
