<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Gbciud
 *
 * @ORM\Table(name="GbCiud")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\GbciudRepository")
 */
class Gbciud
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
     * @ORM\Column(name="codigo", type="string", length=5, nullable=false)
     */
    private $codigo;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var Gbdepa
     *
     * @ORM\ManyToOne(targetEntity="Gbdepa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="GbDepa_id", referencedColumnName="id")
     * })
     */
    private $gbdepa;



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
     * Set nombre
     *
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set gbdepa
     *
     * @param Vimelab\ScontrolBundle\Entity\Gbdepa $gbdepa
     */
    public function setGbdepa(\Vimelab\ScontrolBundle\Entity\Gbdepa $gbdepa)
    {
        $this->gbdepa = $gbdepa;
    }

    /**
     * Get gbdepa
     *
     * @return Vimelab\ScontrolBundle\Entity\Gbdepa
     */
    public function getGbdepa()
    {
        return $this->gbdepa;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}
