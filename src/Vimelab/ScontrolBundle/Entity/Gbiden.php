<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Gbiden
 *
 * @ORM\Table(name="GbIden")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\GbidenRepository")
 */
class Gbiden
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
     * @var string $sigla
     *
     * @ORM\Column(name="sigla", type="string", length=5, nullable=false)
     */
    private $sigla;

    /**
     * @var string $detalle
     *
     * @ORM\Column(name="detalle", type="string", length=50, nullable=false)
     */
    private $detalle;



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
     * Set sigla
     *
     * @param string $sigla
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;
    }

    /**
     * Get sigla
     *
     * @return string
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * Set detalle
     *
     * @param string $detalle
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;
    }

    /**
     * Get detalle
     *
     * @return string
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    public function __toString()
    {
        return $this->detalle;
    }
}
