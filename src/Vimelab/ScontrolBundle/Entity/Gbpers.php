<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Gbpers
 *
 * @ORM\Table(name="GbPers")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\GbpersRepository")
 */
class Gbpers
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
     * @var string $identificacion
     *
     * @ORM\Column(name="identificacion", type="string", length=20, nullable=false)
     */
    private $identificacion;

    /**
     * @var string $prinom
     *
     * @ORM\Column(name="prinom", type="string", length=25, nullable=false)
     */
    private $prinom;

    /**
     * @var string $segnom
     *
     * @ORM\Column(name="segnom", type="string", length=25, nullable=true)
     */
    private $segnom;

    /**
     * @var string $priape
     *
     * @ORM\Column(name="priape", type="string", length=25, nullable=false)
     */
    private $priape;

    /**
     * @var string $segape
     *
     * @ORM\Column(name="segape", type="string", length=25, nullable=true)
     */
    private $segape;

    /**
     * @var date $nacimiento
     *
     * @ORM\Column(name="nacimiento", type="date", nullable=false)
     */
    private $nacimiento;

    /**
     * @var string $telefono
     *
     * @ORM\Column(name="telefono", type="string", length=25, nullable=false)
     */
    private $telefono;

    /**
     * @var string $direccion
     *
     * @ORM\Column(name="direccion", type="string", length=50, nullable=false)
     */
    private $direccion;

    /**
     * @var string $correo
     *
     * @ORM\Column(name="correo", type="string", length=50, nullable=true)
     */
    private $correo;

    /**
     * @var date $ingreso
     *
     * @ORM\Column(name="ingreso", type="date", nullable=false)
     */
    private $ingreso;

    /**
     * @var boolean $pdatos
     *
     * @ORM\Column(name="pdatos", type="boolean", nullable=false)
     */
    private $pdatos;

    /**
     * @var string $estado
     *
     * @ORM\Column(name="estado", type="string", nullable=false)
     */
    private $estado;

    /**
     * @var Gbsucu
     *
     * @ORM\ManyToOne(targetEntity="Gbsucu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="GbSucu_id", referencedColumnName="id")
     * })
     */
    private $gbsucu;

    /**
     * @var Gbciud
     *
     * @ORM\ManyToOne(targetEntity="Gbciud")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="GbCiud_id", referencedColumnName="id")
     * })
     */
    private $gbciud;

    /**
     * @var Gbiden
     *
     * @ORM\ManyToOne(targetEntity="Gbiden")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="GbIden_id", referencedColumnName="id")
     * })
     */
    private $gbiden;

    /**
     * @var Gbcarg
     *
     * @ORM\ManyToOne(targetEntity="Gbcarg")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="GbCarg_id", referencedColumnName="id")
     * })
     */
    private $gbcarg;



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
     * Set prinom
     *
     * @param string $prinom
     */
    public function setPrinom($prinom)
    {
        $this->prinom = $prinom;
    }

    /**
     * Get prinom
     *
     * @return string
     */
    public function getPrinom()
    {
        return $this->prinom;
    }

    /**
     * Set segnom
     *
     * @param string $segnom
     */
    public function setSegnom($segnom)
    {
        $this->segnom = $segnom;
    }

    /**
     * Get segnom
     *
     * @return string
     */
    public function getSegnom()
    {
        return $this->segnom;
    }

    /**
     * Set priape
     *
     * @param string $priape
     */
    public function setPriape($priape)
    {
        $this->priape = $priape;
    }

    /**
     * Get priape
     *
     * @return string
     */
    public function getPriape()
    {
        return $this->priape;
    }

    /**
     * Set segape
     *
     * @param string $segape
     */
    public function setSegape($segape)
    {
        $this->segape = $segape;
    }

    /**
     * Get segape
     *
     * @return string
     */
    public function getSegape()
    {
        return $this->segape;
    }

    /**
     * Set nacimiento
     *
     * @param date $nacimiento
     */
    public function setNacimiento($nacimiento)
    {
        $this->nacimiento = $nacimiento;
    }

    /**
     * Get nacimiento
     *
     * @return date
     */
    public function getNacimiento()
    {
        return $this->nacimiento;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set correo
     *
     * @param string $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    /**
     * Get correo
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set ingreso
     *
     * @param date $ingreso
     */
    public function setIngreso($ingreso)
    {
        $this->ingreso = $ingreso;
    }

    /**
     * Get ingreso
     *
     * @return date
     */
    public function getIngreso()
    {
        return $this->ingreso;
    }

    /**
     * Set pdatos
     *
     * @param boolean $pdatos
     */
    public function setPdatos($pdatos)
    {
        $this->pdatos = $pdatos;
    }

    /**
     * Get pdatos
     *
     * @return boolean
     */
    public function getPdatos()
    {
        return $this->pdatos;
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
     * Set gbsucu
     *
     * @param Vimelab\ScontrolBundle\Entity\Gbsucu $gbsucu
     */
    public function setGbsucu(\Vimelab\ScontrolBundle\Entity\Gbsucu $gbsucu)
    {
        $this->gbsucu = $gbsucu;
    }

    /**
     * Get gbsucu
     *
     * @return Vimelab\ScontrolBundle\Entity\Gbsucu
     */
    public function getGbsucu()
    {
        return $this->gbsucu;
    }

    /**
     * Set gbciud
     *
     * @param Vimelab\ScontrolBundle\Entity\Gbciud $gbciud
     */
    public function setGbciud(\Vimelab\ScontrolBundle\Entity\Gbciud $gbciud)
    {
        $this->gbciud = $gbciud;
    }

    /**
     * Get gbciud
     *
     * @return Vimelab\ScontrolBundle\Entity\Gbciud
     */
    public function getGbciud()
    {
        return $this->gbciud;
    }

    /**
     * Set gbiden
     *
     * @param Vimelab\ScontrolBundle\Entity\Gbiden $gbiden
     */
    public function setGbiden(\Vimelab\ScontrolBundle\Entity\Gbiden $gbiden)
    {
        $this->gbiden = $gbiden;
    }

    /**
     * Get gbiden
     *
     * @return Vimelab\ScontrolBundle\Entity\Gbiden
     */
    public function getGbiden()
    {
        return $this->gbiden;
    }

    /**
     * Set gbcarg
     *
     * @param Vimelab\ScontrolBundle\Entity\Gbcarg $gbcarg
     */
    public function setGbcarg(\Vimelab\ScontrolBundle\Entity\Gbcarg $gbcarg)
    {
        $this->gbcarg = $gbcarg;
    }

    /**
     * Get gbcarg
     *
     * @return Vimelab\ScontrolBundle\Entity\Gbcarg
     */
    public function getGbcarg()
    {
        return $this->gbcarg;
    }

    public function __toString()
    {
        return $this->identificacion;
    }
}
