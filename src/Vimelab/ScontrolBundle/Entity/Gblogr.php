<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Gblogr
 *
 * @ORM\Table(name="GbLogr")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\GblogrRepository")
 */
class Gblogr
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
     * @var datetime $fecha
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string $modulo
     *
     * @ORM\Column(name="modulo", type="string", length=6, nullable=false)
     */
    private $modulo;

    /**
     * @var text $accion
     *
     * @ORM\Column(name="accion", type="text", nullable=false)
     */
    private $accion;

    /**
     * @var Gbusua
     *
     * @ORM\ManyToOne(targetEntity="Gbusua")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="GbUsua_id", referencedColumnName="id")
     * })
     */
    private $gbusua;



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
     * @param datetime $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Get fecha
     *
     * @return datetime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set modulo
     *
     * @param string $modulo
     */
    public function setModulo($modulo)
    {
        $this->modulo = $modulo;
    }

    /**
     * Get modulo
     *
     * @return string
     */
    public function getModulo()
    {
        return $this->modulo;
    }

    /**
     * Set accion
     *
     * @param text $accion
     */
    public function setAccion($accion)
    {
        $this->accion = $accion;
    }

    /**
     * Get accion
     *
     * @return text
     */
    public function getAccion()
    {
        return $this->accion;
    }

    /**
     * Set gbusua
     *
     * @param Vimelab\ScontrolBundle\Entity\Gbusua $gbusua
     */
    public function setGbusua(\Vimelab\ScontrolBundle\Entity\Gbusua $gbusua)
    {
        $this->gbusua = $gbusua;
    }

    /**
     * Get gbusua
     *
     * @return Vimelab\ScontrolBundle\Entity\Gbusua
     */
    public function getGbusua()
    {
        return $this->gbusua;
    }

    public function __toString()
    {
        return $this->modulo;
    }
}
