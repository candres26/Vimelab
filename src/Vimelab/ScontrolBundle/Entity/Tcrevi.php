<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Tcrevi
 *
 * @ORM\Table(name="TcRevi")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\TcreviRepository")
 */
class Tcrevi
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
     * @var time $inicio
     *
     * @ORM\Column(name="inicio", type="time", nullable=false)
     */
    private $inicio;

    /**
     * @var time $fin
     *
     * @ORM\Column(name="fin", type="time", nullable=false)
     */
    private $fin;

    /**
     * @var text $entrevistados
     *
     * @ORM\Column(name="entrevistados", type="text", nullable=false)
     */
    private $entrevistados;

    /**
     * @var text $resumen
     *
     * @ORM\Column(name="resumen", type="text", nullable=false)
     */
    private $resumen;

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
     * @var Gbpers
     *
     * @ORM\ManyToOne(targetEntity="Gbpers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="GbPers_id", referencedColumnName="id")
     * })
     */
    private $gbpers;



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
     * @param time $inicio
     */
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;
    }

    /**
     * Get inicio
     *
     * @return time
     */
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * Set fin
     *
     * @param time $fin
     */
    public function setFin($fin)
    {
        $this->fin = $fin;
    }

    /**
     * Get fin
     *
     * @return time
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set entrevistados
     *
     * @param text $entrevistados
     */
    public function setEntrevistados($entrevistados)
    {
        $this->entrevistados = $entrevistados;
    }

    /**
     * Get entrevistados
     *
     * @return text
     */
    public function getEntrevistados()
    {
        return $this->entrevistados;
    }

    /**
     * Set resumen
     *
     * @param text $resumen
     */
    public function setResumen($resumen)
    {
        $this->resumen = $resumen;
    }

    /**
     * Get resumen
     *
     * @return text
     */
    public function getResumen()
    {
        return $this->resumen;
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

    public function __toString()
    {
        return $this->id;
    }
}
