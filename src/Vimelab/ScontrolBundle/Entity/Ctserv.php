<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Ctserv
 *
 * @ORM\Table(name="CtServ")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\CtservRepository")
 */
class Ctserv
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
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var decimal $iva
     *
     * @ORM\Column(name="iva", type="decimal", nullable=false)
     */
    private $iva;

    /**
     * @var integer $tipo
     *
     * @ORM\Column(name="tipo", type="integer", nullable=false)
     */
    private $tipo;



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
     * Set tipo
     *
     * @param integer $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * Get tipo
     *
     * @return integer
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}
