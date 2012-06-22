<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Tcdeta
 *
 * @ORM\Table(name="TcDeta")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\TcdetaRepository")
 */
class Tcdeta
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
     * @var string $evitable
     *
     * @ORM\Column(name="evitable", type="string", length=1, nullable=false)
     */
    private $evitable;

    /**
     * @var string $estimacion
     *
     * @ORM\Column(name="estimacion", type="string", length=1, nullable=false)
     */
    private $estimacion;

    /**
     * @var string $probabilidad
     *
     * @ORM\Column(name="probabilidad", type="string", length=1, nullable=false)
     */
    private $probabilidad;

    /**
     * @var string $consecuencia
     *
     * @ORM\Column(name="consecuencia", type="string", length=1, nullable=false)
     */
    private $consecuencia;

    /**
     * @var text $detalle
     *
     * @ORM\Column(name="detalle", type="text", nullable=false)
     */
    private $detalle;

    /**
     * @var Tcrevi
     *
     * @ORM\ManyToOne(targetEntity="Tcrevi")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TcRevi_id", referencedColumnName="id")
     * })
     */
    private $tcrevi;

    /**
     * @var Tcaspe
     *
     * @ORM\ManyToOne(targetEntity="Tcaspe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TcAspe_id", referencedColumnName="id")
     * })
     */
    private $tcaspe;



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
     * Set evitable
     *
     * @param string $evitable
     */
    public function setEvitable($evitable)
    {
        $this->evitable = $evitable;
    }

    /**
     * Get evitable
     *
     * @return string
     */
    public function getEvitable()
    {
        return $this->evitable;
    }

    /**
     * Set estimacion
     *
     * @param string $estimacion
     */
    public function setEstimacion($estimacion)
    {
        $this->estimacion = $estimacion;
    }

    /**
     * Get estimacion
     *
     * @return string
     */
    public function getEstimacion()
    {
        return $this->estimacion;
    }

    /**
     * Set probabilidad
     *
     * @param string $probabilidad
     */
    public function setProbabilidad($probabilidad)
    {
        $this->probabilidad = $probabilidad;
    }

    /**
     * Get probabilidad
     *
     * @return string
     */
    public function getProbabilidad()
    {
        return $this->probabilidad;
    }

    /**
     * Set consecuencia
     *
     * @param string $consecuencia
     */
    public function setConsecuencia($consecuencia)
    {
        $this->consecuencia = $consecuencia;
    }

    /**
     * Get consecuencia
     *
     * @return string
     */
    public function getConsecuencia()
    {
        return $this->consecuencia;
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
     * Set tcrevi
     *
     * @param Vimelab\ScontrolBundle\Entity\Tcrevi $tcrevi
     */
    public function setTcrevi(\Vimelab\ScontrolBundle\Entity\Tcrevi $tcrevi)
    {
        $this->tcrevi = $tcrevi;
    }

    /**
     * Get tcrevi
     *
     * @return Vimelab\ScontrolBundle\Entity\Tcrevi
     */
    public function getTcrevi()
    {
        return $this->tcrevi;
    }

    /**
     * Set tcaspe
     *
     * @param Vimelab\ScontrolBundle\Entity\Tcaspe $tcaspe
     */
    public function setTcaspe(\Vimelab\ScontrolBundle\Entity\Tcaspe $tcaspe)
    {
        $this->tcaspe = $tcaspe;
    }

    /**
     * Get tcaspe
     *
     * @return Vimelab\ScontrolBundle\Entity\Tcaspe
     */
    public function getTcaspe()
    {
        return $this->tcaspe;
    }

    public function __toString()
    {
        return $this->id;
    }
}
