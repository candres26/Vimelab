<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Gbcorp
 *
 * @ORM\Table(name="GbCorp")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\GbcorpRepository")
 */
class Gbcorp
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
     * @var string $direccion
     *
     * @ORM\Column(name="direccion", type="string", length=50, nullable=false)
     */
    private $direccion;
        
    /**
     * @var string $telefono
     *
     * @ORM\Column(name="telefono", type="string", length=25, nullable=false)
     */
    private $telefono;

    /**
     * @var string $fax
     *
     * @ORM\Column(name="fax", type="string", length=25, nullable=true)
     */
    private $fax;

    /**
     * @var string $correo
     *
     * @ORM\Column(name="correo", type="string", length=50, nullable=false)
     */
    private $correo;
    
    /**
     * @var string $web
     *
     * @ORM\Column(name="web", type="string", length=50, nullable=true)
     */
    private $web;
    
    /**
     * @var text $logo
     *
     * @ORM\Column(name="logo", type="text", nullable=true)
     */
    private $logo;

    /**
     * @var Gbiden
     *
     * @ORM\ManyToOne(targetEntity="Gbiden")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EmpresaGbIden_id", referencedColumnName="id")
     * })
     */
    private $empresagbiden;

    /**
     * @var Gbiden
     *
     * @ORM\ManyToOne(targetEntity="Gbiden")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="RepresentanteGbIden_id", referencedColumnName="id")
     * })
     */
    private $representantegbiden;

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
     * Set fax
     *
     * @param string $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
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
     * Set logo
     *
     * @param text $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * Get logo
     *
     * @return text
     */
    public function getLogo()
    {
        return $this->logo;
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

    public function __toString()
    {
        return $this->nombre;
    }
}
