<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Gbcnae
 *
 * @ORM\Table(name="GbCnae")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\GbcnaeRepository")
 */
class Gbcnae
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $codigo
     *
     * @ORM\Column(name="codigo", type="string", length=15, nullable=false)
     */
    private $codigo;

    /**
     * @var string $actEcon
     *
     * @ORM\Column(name="act_econ", type="string", length=50, nullable=false)
     */
    private $actEcon;

    /**
     * @var string $alternativo
     *
     * @ORM\Column(name="alternativo", type="string", length=50, nullable=true)
     */
    private $alternativo;



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
     * Set codigo
     *
     * @param string $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set actEcon
     *
     * @param string $actEcon
     */
    public function setActEcon($actEcon)
    {
        $this->actEcon = $actEcon;
    }

    /**
     * Get actEcon
     *
     * @return string
     */
    public function getActEcon()
    {
        return $this->actEcon;
    }

    /**
     * Set alternativo
     *
     * @param string $alternativo
     */
    public function setAlternativo($alternativo)
    {
        $this->alternativo = $alternativo;
    }

    /**
     * Get alternativo
     *
     * @return string
     */
    public function getAlternativo()
    {
        return $this->alternativo;
    }

    public function __toString()
    {
        return $this->actEcon;
    }
}
