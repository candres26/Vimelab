<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Gbsucu
 *
 * @ORM\Table(name="GbSucu")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\GbsucuRepository")
 */
class Gbsucu
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
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var string $telefono
     *
     * @ORM\Column(name="telefono", type="string", length=25, nullable=false)
     */
    private $telefono;

    /**
     * @var string $tele2
     *
     * @ORM\Column(name="tele2", type="string", length=25, nullable=true)
     */
    private $tele2;

    /**
     * @var string $fax
     *
     * @ORM\Column(name="fax", type="string", length=25, nullable=true)
     */
    private $fax;

    /**
     * @var string $contacto
     *
     * @ORM\Column(name="contacto", type="string", length=25, nullable=true)
     */
    private $contacto;

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
     * @var Gbempr
     *
     * @ORM\ManyToOne(targetEntity="Gbempr")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="GbEmpr_id", referencedColumnName="id")
     * })
     */
    private $gbempr;

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
     * Set tele2
     *
     * @param string $tele2
     */
    public function setTele2($tele2)
    {
        $this->tele2 = $tele2;
    }

    /**
     * Get tele2
     *
     * @return string
     */
    public function getTele2()
    {
        return $this->tele2;
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
     * Set contacto
     *
     * @param string $contacto
     */
    public function setContacto($contacto)
    {
        $this->contacto = $contacto;
    }

    /**
     * Get contacto
     *
     * @return string
     */
    public function getContacto()
    {
        return $this->contacto;
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
        return $this->getGbempr()->getNombre()." - ".$this->nombre;
    }
}
