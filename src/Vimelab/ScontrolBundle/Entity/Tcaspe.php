<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Tcaspe
 *
 * @ORM\Table(name="TcAspe")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\TcaspeRepository")
 */
class Tcaspe
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
     * @var string $codigo
     *
     * @ORM\Column(name="codigo", type="string", length=10, nullable=false)
     */
    private $codigo;

    /**
     * @var text $nombre
     *
     * @ORM\Column(name="nombre", type="text", nullable=false)
     */
    private $nombre;

    /**
     * @var text $criterio
     *
     * @ORM\Column(name="criterio", type="text", nullable=true)
     */
    private $criterio;

    /**
     * @var text $medida
     *
     * @ORM\Column(name="medida", type="text", nullable=true)
     */
    private $medida;



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
     * Set codigo
     *
     * @param string $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set nombre
     *
     * @param text $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get nombre
     *
     * @return text
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set criterio
     *
     * @param text $criterio
     */
    public function setCriterio($criterio)
    {
        $this->criterio = $criterio;
    }

    /**
     * Get criterio
     *
     * @return text
     */
    public function getCriterio()
    {
        return $this->criterio;
    }

    /**
     * Set medida
     *
     * @param text $medida
     */
    public function setMedida($medida)
    {
        $this->medida = $medida;
    }

    /**
     * Get medida
     *
     * @return text
     */
    public function getMedida()
    {
        return $this->medida;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}
