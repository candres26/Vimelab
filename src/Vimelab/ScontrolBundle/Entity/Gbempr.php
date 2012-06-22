<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Gbempr
 *
 * @ORM\Table(name="GbEmpr")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\GbemprRepository")
 */
class Gbempr
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
     * @var string $identificacion
     *
     * @ORM\Column(name="identificacion", type="string", length=25, nullable=false)
     */
    private $identificacion;

    /**
     * @var string $tipo
     *
     * @ORM\Column(name="tipo", type="string", length=1, nullable=false)
     */
    private $tipo;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string $rplegal
     *
     * @ORM\Column(name="rplegal", type="string", length=100, nullable=false)
     */
    private $rplegal;

    /**
     * @var string $identrplegal
     *
     * @ORM\Column(name="identrplegal", type="string", length=20, nullable=false)
     */
    private $identrplegal;

    /**
     * @var string $web
     *
     * @ORM\Column(name="web", type="string", length=50, nullable=true)
     */
    private $web;

    /**
     * @var Gbcnae
     *
     * @ORM\ManyToOne(targetEntity="Gbcnae")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="GbCnae_id", referencedColumnName="id")
     * })
     */
    private $gbcnae;

    /**
     * @var Gbiden
     *
     * @ORM\ManyToOne(targetEntity="Gbiden")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipoide", referencedColumnName="id")
     * })
     */
    private $tipoide;



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
     * Set identificacion
     *
     * @param string $identificacion
     */
    public function setIdentificacion($identificacion)
    {
        $this->identificacion = $identificacion;
    }

    /**
     * Get identificacion
     *
     * @return string
     */
    public function getIdentificacion()
    {
        return $this->identificacion;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
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
     * Set rplegal
     *
     * @param string $rplegal
     */
    public function setRplegal($rplegal)
    {
        $this->rplegal = $rplegal;
    }

    /**
     * Get rplegal
     *
     * @return string
     */
    public function getRplegal()
    {
        return $this->rplegal;
    }

    /**
     * Set identrplegal
     *
     * @param string $identrplegal
     */
    public function setIdentrplegal($identrplegal)
    {
        $this->identrplegal = $identrplegal;
    }

    /**
     * Get identrplegal
     *
     * @return string
     */
    public function getIdentrplegal()
    {
        return $this->identrplegal;
    }

    /**
     * Set web
     *
     * @param string $web
     */
    public function setWeb($web)
    {
        $this->web = $web;
    }

    /**
     * Get web
     *
     * @return string
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Set gbcnae
     *
     * @param Vimelab\ScontrolBundle\Entity\Gbcnae $gbcnae
     */
    public function setGbcnae(\Vimelab\ScontrolBundle\Entity\Gbcnae $gbcnae)
    {
        $this->gbcnae = $gbcnae;
    }

    /**
     * Get gbcnae
     *
     * @return Vimelab\ScontrolBundle\Entity\Gbcnae
     */
    public function getGbcnae()
    {
        return $this->gbcnae;
    }

    /**
     * Set tipoide
     *
     * @param Vimelab\ScontrolBundle\Entity\Gbiden $tipoide
     */
    public function setTipoide(\Vimelab\ScontrolBundle\Entity\Gbiden $tipoide)
    {
        $this->tipoide = $tipoide;
    }

    /**
     * Get tipoide
     *
     * @return Vimelab\ScontrolBundle\Entity\Gbiden
     */
    public function getTipoide()
    {
        return $this->tipoide;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}
