<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Ctcont
 *
 * @ORM\Table(name="CtCont")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\CtcontRepository")
 */
class Ctcont
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
     * @var date $inicio
     *
     * @ORM\Column(name="inicio", type="date", nullable=false)
     */
    private $inicio;

    /**
     * @var date $fin
     *
     * @ORM\Column(name="fin", type="date", nullable=false)
     */
    private $fin;

    /**
     * @var string $identcontratista
     *
     * @ORM\Column(name="identcontratista", type="string", length=20, nullable=false)
     */
    private $identcontratista;

    /**
     * @var string $cargocontratista
     *
     * @ORM\Column(name="cargocontratista", type="string", length=50, nullable=false)
     */
    private $cargocontratista;

    /**
     * @var string $nombrecontratista
     *
     * @ORM\Column(name="nombrecontratista", type="string", length=100, nullable=false)
     */
    private $nombrecontratista;

    /**
     * @var string $direccioncontratista
     *
     * @ORM\Column(name="direccioncontratista", type="string", length=100, nullable=false)
     */
    private $direccioncontratista;

    /**
     * @var string $identcontratante
     *
     * @ORM\Column(name="identcontratante", type="string", length=20, nullable=false)
     */
    private $identcontratante;

    /**
     * @var string $cargocontratante
     *
     * @ORM\Column(name="cargocontratante", type="string", length=50, nullable=false)
     */
    private $cargocontratante;

    /**
     * @var string $nombrecontratante
     *
     * @ORM\Column(name="nombrecontratante", type="string", length=100, nullable=false)
     */
    private $nombrecontratante;

    /**
     * @var string $direccioncontratante
     *
     * @ORM\Column(name="direccioncontratante", type="string", length=100, nullable=false)
     */
    private $direccioncontratante;

    /**
     * @var string $ntrabajadores
     *
     * @ORM\Column(name="ntrabajadores", type="string", length=5, nullable=false)
     */
    private $ntrabajadores;

    /**
     * @var string $revision
     *
     * @ORM\Column(name="revision", type="string", length=1, nullable=false)
     */
    private $revision;

    /**
     * @var integer $aviso
     *
     * @ORM\Column(name="aviso", type="integer", nullable=false)
     */
    private $aviso;

    /**
     * @var integer $costovigencia
     *
     * @ORM\Column(name="costovigencia", type="integer", nullable=false)
     */
    private $costovigencia;

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
     * @var decimal $saldo
     *
     * @ORM\Column(name="saldo", type="decimal", nullable=false)
     */
    private $saldo;

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
     * @var Gbiden
     *
     * @ORM\ManyToOne(targetEntity="Gbiden")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ContratanteGbIden_id", referencedColumnName="id")
     * })
     */
    private $contratantegbiden;

    /**
     * @var Gbiden
     *
     * @ORM\ManyToOne(targetEntity="Gbiden")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ContratistaGbIden_id", referencedColumnName="id")
     * })
     */
    private $contratistagbiden;

    /**
     * @var Gbciud
     *
     * @ORM\ManyToOne(targetEntity="Gbciud")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FirmaGbCiud_id", referencedColumnName="id")
     * })
     */
    private $firmagbciud;

    /**
     * @var Gbciud
     *
     * @ORM\ManyToOne(targetEntity="Gbciud")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="LegalGbCiud_id", referencedColumnName="id")
     * })
     */
    private $legalgbciud;



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
     * Set inicio
     *
     * @param date $inicio
     */
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;
    }

    /**
     * Get inicio
     *
     * @return date
     */
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * Set fin
     *
     * @param date $fin
     */
    public function setFin($fin)
    {
        $this->fin = $fin;
    }

    /**
     * Get fin
     *
     * @return date
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set identcontratista
     *
     * @param string $identcontratista
     */
    public function setIdentcontratista($identcontratista)
    {
        $this->identcontratista = $identcontratista;
    }

    /**
     * Get identcontratista
     *
     * @return string
     */
    public function getIdentcontratista()
    {
        return $this->identcontratista;
    }

    /**
     * Set cargocontratista
     *
     * @param string $cargocontratista
     */
    public function setCargocontratista($cargocontratista)
    {
        $this->cargocontratista = $cargocontratista;
    }

    /**
     * Get cargocontratista
     *
     * @return string
     */
    public function getCargocontratista()
    {
        return $this->cargocontratista;
    }

    /**
     * Set nombrecontratista
     *
     * @param string $nombrecontratista
     */
    public function setNombrecontratista($nombrecontratista)
    {
        $this->nombrecontratista = $nombrecontratista;
    }

    /**
     * Get nombrecontratista
     *
     * @return string
     */
    public function getNombrecontratista()
    {
        return $this->nombrecontratista;
    }

    /**
     * Set direccioncontratista
     *
     * @param string $direccioncontratista
     */
    public function setDireccioncontratista($direccioncontratista)
    {
        $this->direccioncontratista = $direccioncontratista;
    }

    /**
     * Get direccioncontratista
     *
     * @return string
     */
    public function getDireccioncontratista()
    {
        return $this->direccioncontratista;
    }

    /**
     * Set identcontratante
     *
     * @param string $identcontratante
     */
    public function setIdentcontratante($identcontratante)
    {
        $this->identcontratante = $identcontratante;
    }

    /**
     * Get identcontratante
     *
     * @return string
     */
    public function getIdentcontratante()
    {
        return $this->identcontratante;
    }

    /**
     * Set cargocontratante
     *
     * @param string $cargocontratante
     */
    public function setCargocontratante($cargocontratante)
    {
        $this->cargocontratante = $cargocontratante;
    }

    /**
     * Get cargocontratante
     *
     * @return string
     */
    public function getCargocontratante()
    {
        return $this->cargocontratante;
    }

    /**
     * Set nombrecontratante
     *
     * @param string $nombrecontratante
     */
    public function setNombrecontratante($nombrecontratante)
    {
        $this->nombrecontratante = $nombrecontratante;
    }

    /**
     * Get nombrecontratante
     *
     * @return string
     */
    public function getNombrecontratante()
    {
        return $this->nombrecontratante;
    }

    /**
     * Set direccioncontratante
     *
     * @param string $direccioncontratante
     */
    public function setDireccioncontratante($direccioncontratante)
    {
        $this->direccioncontratante = $direccioncontratante;
    }

    /**
     * Get direccioncontratante
     *
     * @return string
     */
    public function getDireccioncontratante()
    {
        return $this->direccioncontratante;
    }

    /**
     * Set ntrabajadores
     *
     * @param string $ntrabajadores
     */
    public function setNtrabajadores($ntrabajadores)
    {
        $this->ntrabajadores = $ntrabajadores;
    }

    /**
     * Get ntrabajadores
     *
     * @return string
     */
    public function getNtrabajadores()
    {
        return $this->ntrabajadores;
    }

    /**
     * Set revision
     *
     * @param string $revision
     */
    public function setRevision($revision)
    {
        $this->revision = $revision;
    }

    /**
     * Get revision
     *
     * @return string
     */
    public function getRevision()
    {
        return $this->revision;
    }

    /**
     * Set aviso
     *
     * @param integer $aviso
     */
    public function setAviso($aviso)
    {
        $this->aviso = $aviso;
    }

    /**
     * Get aviso
     *
     * @return integer
     */
    public function getAviso()
    {
        return $this->aviso;
    }

    /**
     * Set costovigencia
     *
     * @param integer $costovigencia
     */
    public function setCostovigencia($costovigencia)
    {
        $this->costovigencia = $costovigencia;
    }

    /**
     * Get costovigencia
     *
     * @return integer
     */
    public function getCostovigencia()
    {
        return $this->costovigencia;
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
     * Set saldo
     *
     * @param decimal $saldo
     */
    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;
    }

    /**
     * Get saldo
     *
     * @return decimal
     */
    public function getSaldo()
    {
        return $this->saldo;
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

    /**
     * Set contratantegbiden
     *
     * @param Vimelab\ScontrolBundle\Entity\Gbiden $contratantegbiden
     */
    public function setContratantegbiden(\Vimelab\ScontrolBundle\Entity\Gbiden $contratantegbiden)
    {
        $this->contratantegbiden = $contratantegbiden;
    }

    /**
     * Get contratantegbiden
     *
     * @return Vimelab\ScontrolBundle\Entity\Gbiden
     */
    public function getContratantegbiden()
    {
        return $this->contratantegbiden;
    }

    /**
     * Set contratistagbiden
     *
     * @param Vimelab\ScontrolBundle\Entity\Gbiden $contratistagbiden
     */
    public function setContratistagbiden(\Vimelab\ScontrolBundle\Entity\Gbiden $contratistagbiden)
    {
        $this->contratistagbiden = $contratistagbiden;
    }

    /**
     * Get contratistagbiden
     *
     * @return Vimelab\ScontrolBundle\Entity\Gbiden
     */
    public function getContratistagbiden()
    {
        return $this->contratistagbiden;
    }

    /**
     * Set firmagbciud
     *
     * @param Vimelab\ScontrolBundle\Entity\Gbciud $firmagbciud
     */
    public function setFirmagbciud(\Vimelab\ScontrolBundle\Entity\Gbciud $firmagbciud)
    {
        $this->firmagbciud = $firmagbciud;
    }

    /**
     * Get firmagbciud
     *
     * @return Vimelab\ScontrolBundle\Entity\Gbciud
     */
    public function getFirmagbciud()
    {
        return $this->firmagbciud;
    }

    /**
     * Set legalgbciud
     *
     * @param Vimelab\ScontrolBundle\Entity\Gbciud $legalgbciud
     */
    public function setLegalgbciud(\Vimelab\ScontrolBundle\Entity\Gbciud $legalgbciud)
    {
        $this->legalgbciud = $legalgbciud;
    }

    /**
     * Get legalgbciud
     *
     * @return Vimelab\ScontrolBundle\Entity\Gbciud
     */
    public function getLegalgbciud()
    {
        return $this->legalgbciud;
    }

    public function __toString()
    {
        return $this->getGbempr()->getNombre().": ".$this->id;
    }
}
