<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Mdexam
 *
 * @ORM\Table(name="MdExam")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\MdexamRepository")
 */
class Mdexam
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
     * @ORM\Column(name="codigo", type="string", length=25, nullable=false)
     */
    private $codigo;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var string $alternativo
     *
     * @ORM\Column(name="alternativo", type="string", length=100, nullable=true)
     */
    private $alternativo;



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
     * Set alternativo
     *
     * @param string $alternativo
     */
    public function setAlternativo($alternativo)
    {
        $this->alternativo = $alternativo;
    }

    /**
     * Get alternativo
     *
     * @return string
     */
    public function getAlternativo()
    {
        return $this->alternativo;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}
