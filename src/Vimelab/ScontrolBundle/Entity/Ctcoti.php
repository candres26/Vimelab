<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Ctcoti
 *
 * @ORM\Table(name="CtCoti")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\CtcotiRepository")
 */
class Ctcoti
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
     * @var string $modalidad
     *
     * @ORM\Column(name="modalidad", type="string", length=50, nullable=false)
     */
    private $modalidad;

    /**
     * @var string $trabajadores
     *
     * @ORM\Column(name="trabajadores", type="string", length=50, nullable=false)
     */
    private $trabajadores;

    /**
     * @var string $centros
     *
     * @ORM\Column(name="centros", type="string", length=50, nullable=false)
     */
    private $centros;

    /**
     * @var string $vencimiento
     *
     * @ORM\Column(name="vencimiento", type="string", length=50, nullable=false)
     */
    private $vencimiento;

    /**
     * @var string $nivel
     *
     * @ORM\Column(name="nivel", type="string", length=50, nullable=false)
     */
    private $nivel;

    /**
     * @var string $subtotal
     *
     * @ORM\Column(name="subtotal", type="string", length=50, nullable=false)
     */
    private $subtotal;

    /**
     * @var string $iva
     *
     * @ORM\Column(name="iva", type="string", length=50, nullable=false)
     */
    private $iva;

    /**
     * @var string $descuento
     *
     * @ORM\Column(name="descuento", type="string", length=50, nullable=false)
     */
    private $descuento;

    /**
     * @var string $total
     *
     * @ORM\Column(name="total", type="string", length=50, nullable=false)
     */
    private $total;

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
     * Set modalidad
     *
     * @param string $modalidad
     */
    public function setModalidad($modalidad)
    {
        $this->modalidad = $modalidad;
    }

    /**
     * Get modalidad
     *
     * @return string
     */
    public function getModalidad()
    {
        return $this->modalidad;
    }

    /**
     * Set trabajadores
     *
     * @param string $trabajadores
     */
    public function setTrabajadores($trabajadores)
    {
        $this->trabajadores = $trabajadores;
    }

    /**
     * Get trabajadores
     *
     * @return string
     */
    public function getTrabajadores()
    {
        return $this->trabajadores;
    }

    /**
     * Set centros
     *
     * @param string $centros
     */
    public function setCentros($centros)
    {
        $this->centros = $centros;
    }

    /**
     * Get centros
     *
     * @return string
     */
    public function getCentros()
    {
        return $this->centros;
    }

    /**
     * Set vencimiento
     *
     * @param string $vencimiento
     */
    public function setVencimiento($vencimiento)
    {
        $this->vencimiento = $vencimiento;
    }

    /**
     * Get vencimiento
     *
     * @return string
     */
    public function getVencimiento()
    {
        return $this->vencimiento;
    }

    /**
     * Set nivel
     *
     * @param string $nivel
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
    }

    /**
     * Get nivel
     *
     * @return string
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set subtotal
     *
     * @param string $subtotal
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;
    }

    /**
     * Get subtotal
     *
     * @return string
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Set iva
     *
     * @param string $iva
     */
    public function setIva($iva)
    {
        $this->iva = $iva;
    }

    /**
     * Get iva
     *
     * @return string
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set descuento
     *
     * @param string $descuento
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    }

    /**
     * Get descuento
     *
     * @return string
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set total
     *
     * @param string $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * Get total
     *
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
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
