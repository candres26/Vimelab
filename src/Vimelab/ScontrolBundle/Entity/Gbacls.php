<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Gbacls
 *
 * @ORM\Table(name="GbAcls")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\GbaclsRepository")
 */
class Gbacls
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
     * @var string $modulo
     *
     * @ORM\Column(name="modulo", type="string", length=10, nullable=false)
     */
    private $modulo;

    /**
     * @var string $accion
     *
     * @ORM\Column(name="accion", type="string", length=50, nullable=false)
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
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
     * @param string $accion
     */
    public function setAccion($accion)
    {
        $this->accion = $accion;
    }

    /**
     * Get accion
     *
     * @return string
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
        return $this->id;
    }
}
