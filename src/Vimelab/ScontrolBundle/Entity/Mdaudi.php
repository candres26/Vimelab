<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Mdaudi
 *
 * @ORM\Table(name="MdAudi")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\MdaudiRepository")
 */
class Mdaudi
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
     * @var string $d500
     *
     * @ORM\Column(name="d500", type="string", nullable=true)
     */
    private $d500;

    /**
     * @var string $i500
     *
     * @ORM\Column(name="i500", type="string", nullable=true)
     */
    private $i500;

    /**
     * @var string $d1000
     *
     * @ORM\Column(name="d1000", type="string", nullable=true)
     */
    private $d1000;

    /**
     * @var string $i1000
     *
     * @ORM\Column(name="i1000", type="string", nullable=true)
     */
    private $i1000;

    /**
     * @var string $d2000
     *
     * @ORM\Column(name="d2000", type="string", nullable=true)
     */
    private $d2000;

    /**
     * @var string $i2000
     *
     * @ORM\Column(name="i2000", type="string", nullable=true)
     */
    private $i2000;

    /**
     * @var string $d3000
     *
     * @ORM\Column(name="d3000", type="string", nullable=true)
     */
    private $d3000;

    /**
     * @var string $i3000
     *
     * @ORM\Column(name="i3000", type="string", nullable=true)
     */
    private $i3000;

    /**
     * @var string $d4000
     *
     * @ORM\Column(name="d4000", type="string", nullable=true)
     */
    private $d4000;

    /**
     * @var string $i4000
     *
     * @ORM\Column(name="i4000", type="string", nullable=true)
     */
    private $i4000;

    /**
     * @var string $d6000
     *
     * @ORM\Column(name="d6000", type="string", nullable=true)
     */
    private $d6000;

    /**
     * @var string $i6000
     *
     * @ORM\Column(name="i6000", type="string", nullable=true)
     */
    private $i6000;

    /**
     * @var string $d8000
     *
     * @ORM\Column(name="d8000", type="string", nullable=true)
     */
    private $d8000;

    /**
     * @var string $i8000
     *
     * @ORM\Column(name="i8000", type="string", nullable=true)
     */
    private $i8000;

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
     * Set d500
     *
     * @param string $d500
     */
    public function setD500($d500)
    {
        $this->d500 = $d500;
    }

    /**
     * Get d500
     *
     * @return string
     */
    public function getD500()
    {
        return $this->d500;
    }

    /**
     * Set i500
     *
     * @param string $i500
     */
    public function setI500($i500)
    {
        $this->i500 = $i500;
    }

    /**
     * Get i500
     *
     * @return string
     */
    public function getI500()
    {
        return $this->i500;
    }

    /**
     * Set d1000
     *
     * @param string $d1000
     */
    public function setD1000($d1000)
    {
        $this->d1000 = $d1000;
    }

    /**
     * Get d1000
     *
     * @return string
     */
    public function getD1000()
    {
        return $this->d1000;
    }

    /**
     * Set i1000
     *
     * @param string $i1000
     */
    public function setI1000($i1000)
    {
        $this->i1000 = $i1000;
    }

    /**
     * Get i1000
     *
     * @return string
     */
    public function getI1000()
    {
        return $this->i1000;
    }

    /**
     * Set d2000
     *
     * @param string $d2000
     */
    public function setD2000($d2000)
    {
        $this->d2000 = $d2000;
    }

    /**
     * Get d2000
     *
     * @return string
     */
    public function getD2000()
    {
        return $this->d2000;
    }

    /**
     * Set i2000
     *
     * @param string $i2000
     */
    public function setI2000($i2000)
    {
        $this->i2000 = $i2000;
    }

    /**
     * Get i2000
     *
     * @return string
     */
    public function getI2000()
    {
        return $this->i2000;
    }

    /**
     * Set d3000
     *
     * @param string $d3000
     */
    public function setD3000($d3000)
    {
        $this->d3000 = $d3000;
    }

    /**
     * Get d3000
     *
     * @return string
     */
    public function getD3000()
    {
        return $this->d3000;
    }

    /**
     * Set i3000
     *
     * @param string $i3000
     */
    public function setI3000($i3000)
    {
        $this->i3000 = $i3000;
    }

    /**
     * Get i3000
     *
     * @return string
     */
    public function getI3000()
    {
        return $this->i3000;
    }

    /**
     * Set d4000
     *
     * @param string $d4000
     */
    public function setD4000($d4000)
    {
        $this->d4000 = $d4000;
    }

    /**
     * Get d4000
     *
     * @return string
     */
    public function getD4000()
    {
        return $this->d4000;
    }

    /**
     * Set i4000
     *
     * @param string $i4000
     */
    public function setI4000($i4000)
    {
        $this->i4000 = $i4000;
    }

    /**
     * Get i4000
     *
     * @return string
     */
    public function getI4000()
    {
        return $this->i4000;
    }

    /**
     * Set d6000
     *
     * @param string $d6000
     */
    public function setD6000($d6000)
    {
        $this->d6000 = $d6000;
    }

    /**
     * Get d6000
     *
     * @return string
     */
    public function getD6000()
    {
        return $this->d6000;
    }

    /**
     * Set i6000
     *
     * @param string $i6000
     */
    public function setI6000($i6000)
    {
        $this->i6000 = $i6000;
    }

    /**
     * Get i6000
     *
     * @return string
     */
    public function getI6000()
    {
        return $this->i6000;
    }

    /**
     * Set d8000
     *
     * @param string $d8000
     */
    public function setD8000($d8000)
    {
        $this->d8000 = $d8000;
    }

    /**
     * Get d8000
     *
     * @return string
     */
    public function getD8000()
    {
        return $this->d8000;
    }

    /**
     * Set i8000
     *
     * @param string $i8000
     */
    public function setI8000($i8000)
    {
        $this->i8000 = $i8000;
    }

    /**
     * Get i8000
     *
     * @return string
     */
    public function getI8000()
    {
        return $this->i8000;
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
