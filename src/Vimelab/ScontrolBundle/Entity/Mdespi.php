<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Mdespi
 *
 * @ORM\Table(name="MdEspi")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\MdespiRepository")
 */
class Mdespi
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
     * @var string $realizado
     *
     * @ORM\Column(name="realizado", type="string", length=1, nullable=false)
     */
    private $realizado;

    /**
     * @var decimal $cv
     *
     * @ORM\Column(name="cv", type="decimal", nullable=false)
     */
    private $cv;

    /**
     * @var decimal $vems
     *
     * @ORM\Column(name="vems", type="decimal", nullable=false)
     */
    private $vems;

    /**
     * @var decimal $tiff
     *
     * @ORM\Column(name="tiff", type="decimal", nullable=false)
     */
    private $tiff;

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
     * Set realizado
     *
     * @param string $realizado
     */
    public function setRealizado($realizado)
    {
        $this->realizado = $realizado;
    }

    /**
     * Get realizado
     *
     * @return string
     */
    public function getRealizado()
    {
        return $this->realizado;
    }

    /**
     * Set cv
     *
     * @param decimal $cv
     */
    public function setCv($cv)
    {
        $this->cv = $cv;
    }

    /**
     * Get cv
     *
     * @return decimal
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * Set vems
     *
     * @param decimal $vems
     */
    public function setVems($vems)
    {
        $this->vems = $vems;
    }

    /**
     * Get vems
     *
     * @return decimal
     */
    public function getVems()
    {
        return $this->vems;
    }

    /**
     * Set tiff
     *
     * @param decimal $tiff
     */
    public function setTiff($tiff)
    {
        $this->tiff = $tiff;
    }

    /**
     * Get tiff
     *
     * @return decimal
     */
    public function getTiff()
    {
        return $this->tiff;
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
