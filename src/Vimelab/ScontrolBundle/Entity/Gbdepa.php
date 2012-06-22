<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Gbdepa
 *
 * @ORM\Table(name="GbDepa")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\GbdepaRepository")
 */
class Gbdepa
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
     * @ORM\Column(name="codigo", type="string", length=2, nullable=false)
     */
    private $codigo;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var Gbpais
     *
     * @ORM\ManyToOne(targetEntity="Gbpais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="GbPais_id", referencedColumnName="id")
     * })
     */
    private $gbpais;



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
     * Set gbpais
     *
     * @param Vimelab\ScontrolBundle\Entity\Gbpais $gbpais
     */
    public function setGbpais(\Vimelab\ScontrolBundle\Entity\Gbpais $gbpais)
    {
        $this->gbpais = $gbpais;
    }

    /**
     * Get gbpais
     *
     * @return Vimelab\ScontrolBundle\Entity\Gbpais
     */
    public function getGbpais()
    {
        return $this->gbpais;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}
