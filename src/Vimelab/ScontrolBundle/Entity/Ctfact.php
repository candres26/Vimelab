<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Ctfact
 *
 * @ORM\Table(name="CtFact")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\CtfactRepository")
 */
class Ctfact
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
     * @var date $fecha
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var date $vencimiento
     *
     * @ORM\Column(name="vencimiento", type="date", nullable=true)
     */
    private $vencimiento;
    
    /**
     * @var date $perini
     *
     * @ORM\Column(name="perini", type="date", nullable=true)
     */
    private $perini;

    /**
     * @var date $perfin
     *
     * @ORM\Column(name="perfin", type="date", nullable=true)
     */
    private $perfin;

    /**
     * @var decimal $subtotal
     *
     * @ORM\Column(name="subtotal", type="decimal", nullable=false)
     */
    private $subtotal;

    /**
     * @var decimal $iva
     *
     * @ORM\Column(name="iva", type="decimal", nullable=false)
     */
    private $iva;

    /**
     * @var decimal $descuento
     *
     * @ORM\Column(name="descuento", type="decimal", nullable=false)
     */
    private $descuento;

    /**
     * @var decimal $total
     *
     * @ORM\Column(name="total", type="decimal", nullable=false)
     */
    private $total;

    /**
     * @var string $estado
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=false)
     */
    private $estado;

    /**
     * @var text $detalle
     *
     * @ORM\Column(name="detalle", type="text", nullable=false)
     */
    private $detalle;

    /**
     * @var text $observaciones
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @var Ctcont
     *
     * @ORM\ManyToOne(targetEntity="Ctcont")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CtCont_id", referencedColumnName="id")
     * })
     */
    private $ctcont;

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
     * @var Gbempr
     *
     * @ORM\ManyToOne(targetEntity="Gbempr")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="GbEmpr_id", referencedColumnName="id")
     * })
     */
    private $gbempr;



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
     * @return date
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set vencimiento
     *
     * @param date $vencimiento
     */
    public function setVencimiento($vencimiento)
    {
        $this->vencimiento = $vencimiento;
    }

    /**
     * Get vencimiento
     *
     * @return date
     */
    public function getVencimiento()
    {
        return $this->vencimiento;
    }

    /**
     * Set perini
     *
     * @param date $perini
     */
    public function setPerini($perini)
    {
        $this->perini = $perini;
    }

    /**
     * Get perini
     *
     * @return date
     */
    public function getPerini()
    {
        return $this->perini;
    }
    
    /**
     * Set perfin
     *
     * @param date $perfin
     */
    public function setPerfin($perfin)
    {
        $this->perfin = $perfin;
    }

    /**
     * Get perfin
     *
     * @return date
     */
    public function getPerfin()
    {
        return $this->perfin;
    }

    /**
     * Set subtotal
     *
     * @param decimal $subtotal
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;
    }

    /**
     * Get subtotal
     *
     * @return decimal
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Set iva
     *
     * @param decimal $iva
     */
    public function setIva($iva)
    {
        $this->iva = $iva;
    }

    /**
     * Get iva
     *
     * @return decimal
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set descuento
     *
     * @param decimal $descuento
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    }

    /**
     * Get descuento
     *
     * @return decimal
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set total
     *
     * @param decimal $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * Get total
     *
     * @return decimal
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set estado
     *
     * @param string $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set detalle
     *
     * @param text $detalle
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;
    }

    /**
     * Get detalle
     *
     * @return text
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * Set observaciones
     *
     * @param text $observaciones
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }

    /**
     * Get observaciones
     *
     * @return text
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set ctcont
     *
     * @param Vimelab\ScontrolBundle\Entity\Ctcont $ctcont
     */
    public function setCtcont(\Vimelab\ScontrolBundle\Entity\Ctcont $ctcont)
    {
        $this->ctcont = $ctcont;
    }

    /**
     * Get ctcont
     *
     * @return Vimelab\ScontrolBundle\Entity\Ctcont
     */
    public function getCtcont()
    {
        return $this->ctcont;
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
     * Set gbempr
     *
     * @param Vimelab\ScontrolBundle\Entity\Gbempr $gbempr
     */
    public function setGbempr(\Vimelab\ScontrolBundle\Entity\Gbempr $gbempr)
    {
        $this->gbempr = $gbempr;
    }

    /**
     * Get gbempr
     *
     * @return Vimelab\ScontrolBundle\Entity\Gbempr
     */
    public function getGbempr()
    {
        return $this->gbempr;
    }

    public function __toString()
    {
        return $this->id;
    }
}
