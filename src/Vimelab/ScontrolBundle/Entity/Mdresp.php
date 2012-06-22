<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Mdresp
 *
 * @ORM\Table(name="MdResp")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\MdrespRepository")
 */
class Mdresp
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
     * @var string $resultado
     *
     * @ORM\Column(name="resultado", type="string", length=1, nullable=false)
     */
    private $resultado;

    /**
     * @var text $detalle
     *
     * @ORM\Column(name="detalle", type="text", nullable=true)
     */
    private $detalle;

    /**
     * @var Mdques
     *
     * @ORM\ManyToOne(targetEntity="Mdques")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MdQues_id", referencedColumnName="id")
     * })
     */
    private $mdques;

    /**
     * @var Mdhist
     *
     * @ORM\ManyToOne(targetEntity="Mdhist")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MdHist_id", referencedColumnName="id")
     * })
     */
    private $mdhist;



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
     * Set resultado
     *
     * @param string $resultado
     */
    public function setResultado($resultado)
    {
        $this->resultado = $resultado;
    }

    /**
     * Get resultado
     *
     * @return string
     */
    public function getResultado()
    {
        return $this->resultado;
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
     * Set mdques
     *
     * @param Vimelab\ScontrolBundle\Entity\Mdques $mdques
     */
    public function setMdques(\Vimelab\ScontrolBundle\Entity\Mdques $mdques)
    {
        $this->mdques = $mdques;
    }

    /**
     * Get mdques
     *
     * @return Vimelab\ScontrolBundle\Entity\Mdques
     */
    public function getMdques()
    {
        return $this->mdques;
    }

    /**
     * Set mdhist
     *
     * @param Vimelab\ScontrolBundle\Entity\Mdhist $mdhist
     */
    public function setMdhist(\Vimelab\ScontrolBundle\Entity\Mdhist $mdhist)
    {
        $this->mdhist = $mdhist;
    }

    /**
     * Get mdhist
     *
     * @return Vimelab\ScontrolBundle\Entity\Mdhist
     */
    public function getMdhist()
    {
        return $this->mdhist;
    }

    public function __toString()
    {
        return $this->id;
    }
}
