<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Mdpato
 *
 * @ORM\Table(name="MdPato")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\MdpatoRepository")
 */
class Mdpato
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
     * @var string $codigo
     *
     * @ORM\Column(name="codigo", type="string", length=10, nullable=false)
     */
    private $codigo;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=250, nullable=false)
     */
    private $nombre;

    /**
     * @var string $alternativo
     *
     * @ORM\Column(name="alternativo", type="string", length=250, nullable=true)
     */
    private $alternativo;

    /**
     * @var Mdgrup
     *
     * @ORM\ManyToOne(targetEntity="Mdgrup")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MdGrup_id", referencedColumnName="id")
     * })
     */
    private $mdgrup;



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

    /**
     * Set mdgrup
     *
     * @param Vimelab\ScontrolBundle\Entity\Mdgrup $mdgrup
     */
    public function setMdgrup(\Vimelab\ScontrolBundle\Entity\Mdgrup $mdgrup)
    {
        $this->mdgrup = $mdgrup;
    }

    /**
     * Get mdgrup
     *
     * @return Vimelab\ScontrolBundle\Entity\Mdgrup 
     */
    public function getMdgrup()
    {
        return $this->mdgrup;
    }

    function resume()
    {
        if(strlen($this->nombre) > 50)
            return substr($this->nombre, 0, 47)."...";
        else
            return $this->nombre;
    }

    public function __toString()
    {
        return $this->codigo."-".$this->nombre;
    }
}
