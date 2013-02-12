<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Mdhist
 *
 * @ORM\Table(name="MdHist")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\MdhistRepository")
 */
class Mdhist
{
    /**
     * @var bigint $id
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var date fecha
     *
     * @ORM\Column(name="fecha", type="date", length=1, nullable=false)
     */
    private $fecha;

    /**
     * @var string menstru
     *
     * @ORM\Column(name="menstru", type="string", nullable=true)
     */
    private $menstru;

    /**
     * @var integer $tipo
     *
     * @ORM\Column(name="tipo", type="integer", nullable=false)
     */
    private $tipo;
	
	/**
     * @var text $comentario
     *
     * @ORM\Column(name="comentario", type="text", nullable=true)
     */
    private $comentario;
	

    /**
     * @var Mdpaci
     *
     * @ORM\ManyToOne(targetEntity="Mdpaci")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MdPaci_id", referencedColumnName="id")
     * })
     */
    private $mdpaci;

    /**
     * @var Gbpers
     *
     * @ORM\ManyToOne(targetEntity="Gbpers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="GbPers_id", referencedColumnName="id")
     * })
     */
    private $gbpers;

    /**
     * @var Tcruta
     *
     * @ORM\ManyToOne(targetEntity="Tcruta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TcRuta_id", referencedColumnName="id")
     * })
     */
    private $tcruta;



    /**
     * Get id
     *
     * @return bigint
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fecha
     *
     * @param date $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Get fecha
     *
     * @return fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set menstru
     *
     * @param string $menstru
     */
    public function setMenstru($menstru)
    {
        $this->menstru = $menstru;
    }

    /**
     * Get menstru
     *
     * @return string
     */
    public function getMenstru()
    {
        return $this->menstru;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * Get tipo
     *
     * @return integer
     */
    public function getTipo()
    {
        return $this->tipo;
    }
	
	 /**
     * Set comentario
     *
     * @param text $comentario
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }

    /**
     * Get comentario
     *
     * @return text
     */
    public function getComentario()
    {
        return $this->comentario;
    }
	

    /**
     * Set mdpaci
     *
     * @param Vimelab\ScontrolBundle\Entity\Mdpaci $mdpaci
     */
    public function setMdpaci(\Vimelab\ScontrolBundle\Entity\Mdpaci $mdpaci)
    {
        $this->mdpaci = $mdpaci;
    }

    /**
     * Get mdpaci
     *
     * @return Vimelab\ScontrolBundle\Entity\Mdpaci
     */
    public function getMdpaci()
    {
        return $this->mdpaci;
    }

    /**
     * Set gbpers
     *
     * @param Vimelab\ScontrolBundle\Entity\Gbpers $gbpers
     */
    public function setGbpers(\Vimelab\ScontrolBundle\Entity\Gbpers $gbpers)
    {
        $this->gbpers = $gbpers;
    }

    /**
     * Get gbpers
     *
     * @return Vimelab\ScontrolBundle\Entity\Gbpers
     */
    public function getGbpers()
    {
        return $this->gbpers;
    }

    /**
     * Set tcruta
     *
     * @param Vimelab\ScontrolBundle\Entity\Tcruta $tcruta
     */
    public function setTcruta(\Vimelab\ScontrolBundle\Entity\Tcruta $tcruta)
    {
        $this->tcruta = $tcruta;
    }

    /**
     * Get tcruta
     *
     * @return Vimelab\ScontrolBundle\Entity\Tcruta
     */
    public function getTcruta()
    {
        return $this->tcruta;
    }
    
    public function __toString()
    {
        return $this->id;
    }
}
