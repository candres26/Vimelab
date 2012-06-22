<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Hslabo
 *
 * @ORM\Table(name="HsLabo")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\HslaboRepository")
 */
class Hslabo
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
     * @var string $empresa
     *
     * @ORM\Column(name="empresa", type="string", length=50, nullable=false)
     */
    private $empresa;

    /**
     * @var date $fingreso
     *
     * @ORM\Column(name="fingreso", type="date", nullable=true)
     */
    private $fingreso;

    /**
     * @var text $actividad
     *
     * @ORM\Column(name="actividad", type="text", nullable=false)
     */
    private $actividad;

    /**
     * @var text $puesto
     *
     * @ORM\Column(name="puesto", type="text", nullable=false)
     */
    private $puesto;

    /**
     * @var text $riesgo
     *
     * @ORM\Column(name="riesgo", type="text", nullable=false)
     */
    private $riesgo;

    /**
     * @var integer $duracion
     *
     * @ORM\Column(name="duracion", type="integer", nullable=false)
     */
    private $duracion;

    /**
     * @var integer $edad
     *
     * @ORM\Column(name="edad", type="integer", nullable=false)
     */
    private $edad;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set empresa
     *
     * @param string $empresa
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    }

    /**
     * Get empresa
     *
     * @return string
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set fingreso
     *
     * @param date $fingreso
     */
    public function setFingreso($fingreso)
    {
        $this->fingreso = $fingreso;
    }

    /**
     * Get fingreso
     *
     * @return date
     */
    public function getFingreso()
    {
        return $this->fingreso;
    }

    /**
     * Set actividad
     *
     * @param text $actividad
     */
    public function setActividad($actividad)
    {
        $this->actividad = $actividad;
    }

    /**
     * Get actividad
     *
     * @return text
     */
    public function getActividad()
    {
        return $this->actividad;
    }

    /**
     * Set puesto
     *
     * @param text $puesto
     */
    public function setPuesto($puesto)
    {
        $this->puesto = $puesto;
    }

    /**
     * Get puesto
     *
     * @return text
     */
    public function getPuesto()
    {
        return $this->puesto;
    }

    /**
     * Set riesgo
     *
     * @param text $riesgo
     */
    public function setRiesgo($riesgo)
    {
        $this->riesgo = $riesgo;
    }

    /**
     * Get riesgo
     *
     * @return text
     */
    public function getRiesgo()
    {
        return $this->riesgo;
    }

    /**
     * Set duracion
     *
     * @param integer $duracion
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    }

    /**
     * Get duracion
     *
     * @return integer
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Set edad
     *
     * @param integer $edad
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;
    }

    /**
     * Get edad
     *
     * @return integer
     */
    public function getEdad()
    {
        return $this->edad;
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

    public function __toString()
    {
        return $this->id;
    }
}
