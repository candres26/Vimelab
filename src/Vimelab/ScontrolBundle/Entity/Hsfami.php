<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Hsfami
 *
 * @ORM\Table(name="HsFami")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\HsfamiRepository")
 */
class Hsfami
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
     * @var string $familiar
     *
     * @ORM\Column(name="familiar", type="string", length=50, nullable=false)
     */
    private $familiar;

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
     * @var Mdpato
     *
     * @ORM\ManyToOne(targetEntity="Mdpato")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MdPato_id", referencedColumnName="id")
     * })
     */
    private $mdpato;



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
     * Set familiar
     *
     * @param string $familiar
     */
    public function setFamiliar($familiar)
    {
        $this->familiar = $familiar;
    }

    /**
     * Get familiar
     *
     * @return string
     */
    public function getFamiliar()
    {
        return $this->familiar;
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
     * Set mdpato
     *
     * @param Vimelab\ScontrolBundle\Entity\Mdpato $mdpato
     */
    public function setMdpato(\Vimelab\ScontrolBundle\Entity\Mdpato $mdpato)
    {
        $this->mdpato = $mdpato;
    }

    /**
     * Get mdpato
     *
     * @return Vimelab\ScontrolBundle\Entity\Mdpato
     */
    public function getMdpato()
    {
        return $this->mdpato;
    }

    public function __toString()
    {
        return $this->id;
    }
}
