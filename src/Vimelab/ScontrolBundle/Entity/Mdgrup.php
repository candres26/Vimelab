<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Mdgrup
 *
 * @ORM\Table(name="MdGrup")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\MdgrupRepository")
 */
class Mdgrup
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
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string $alternativo
     *
     * @ORM\Column(name="alternativo", type="string", length=50, nullable=true)
     */
    private $alternativo;



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
