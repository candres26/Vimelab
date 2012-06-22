<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Tccurs
 *
 * @ORM\Table(name="TcCurs")
* @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\TccursRepository")
 */
class Tccurs
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
     * @var string $empresa
     *
     * @ORM\Column(name="empresa", type="string", length=50, nullable=false)
     */
    private $empresa;

    /**
     * @var date $inicio
     *
     * @ORM\Column(name="inicio", type="date", nullable=false)
     */
    private $inicio;

    /**
     * @var date $fin
     *
     * @ORM\Column(name="fin", type="date", nullable=false)
     */
    private $fin;

    /**
     * @var string $instructor
     *
     * @ORM\Column(name="instructor", type="string", length=100, nullable=false)
     */
    private $instructor;

    /**
     * @var text $detalle
     *
     * @ORM\Column(name="detalle", type="text", nullable=false)
     */
    private $detalle;

    /**
     * @var Mdpaci
     *
     * @ORM\ManyToOne(targetEntity="Mdpaci")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MdPaci_id", referencedColumnName="id")
     * })
     */
    private $mdpaci;

    /**
     * @var Tccapa
     *
     * @ORM\ManyToOne(targetEntity="Tccapa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TcCapa_id", referencedColumnName="id")
     * })
     */
    private $tccapa;



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
     * Set empresa
     *
     * @param string $empresa
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    }

    /**
     * Get empresa
     *
     * @return string
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set inicio
     *
     * @param date $inicio
     */
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;
    }

    /**
     * Get inicio
     *
     * @return date
     */
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * Set fin
     *
     * @param date $fin
     */
    public function setFin($fin)
    {
        $this->fin = $fin;
    }

    /**
     * Get fin
     *
     * @return date
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set instructor
     *
     * @param string $instructor
     */
    public function setInstructor($instructor)
    {
        $this->instructor = $instructor;
    }

    /**
     * Get instructor
     *
     * @return string
     */
    public function getInstructor()
    {
        return $this->instructor;
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
     * Set mdpaci
     *
     * @param Vimelab\ScontrolBundle\Entity\Mdpaci $mdpaci
     */
    public function setMdpaci(\Vimelab\ScontrolBundle\Entity\Mdpaci $mdpaci)
    {
        $this->mdpaci = $mdpaci;
    }

    /**
     * Get mdpaci
     *
     * @return Vimelab\ScontrolBundle\Entity\Mdpaci
     */
    public function getMdpaci()
    {
        return $this->mdpaci;
    }

    /**
     * Set tccapa
     *
     * @param Vimelab\ScontrolBundle\Entity\Tccapa $tccapa
     */
    public function setTccapa(\Vimelab\ScontrolBundle\Entity\Tccapa $tccapa)
    {
        $this->tccapa = $tccapa;
    }

    /**
     * Get tccapa
     *
     * @return Vimelab\ScontrolBundle\Entity\Tccapa
     */
    public function getTccapa()
    {
        return $this->tccapa;
    }

    public function __toString()
    {
        return $this->id;
    }
}
