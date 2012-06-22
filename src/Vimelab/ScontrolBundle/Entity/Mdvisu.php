<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Mdvisu
 *
 * @ORM\Table(name="MdVisu")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\MdvisuRepository")
 */
class Mdvisu
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
     * @var string $lentes
     *
     * @ORM\Column(name="lentes", type="string", length=1, nullable=false)
     */
    private $lentes;

    /**
     * @var string $lentesprueba
     *
     * @ORM\Column(name="lentesprueba", type="string", length=1, nullable=false)
     */
    private $lentesprueba;

    /**
     * @var boolean $miopia
     *
     * @ORM\Column(name="miopia", type="boolean", length=1, nullable=false)
     */
    private $miopia;

    /**
     * @var boolean $hipermetropia
     *
     * @ORM\Column(name="hipermetropia", type="boolean", length=1, nullable=false)
     */
    private $hipermetropia;

    /**
     * @var boolean $astigmatismo
     *
     * @ORM\Column(name="astigmatismo", type="boolean", length=1, nullable=false)
     */
    private $astigmatismo;

    /**
     * @var boolean $bif
     *
     * @ORM\Column(name="bif", type="boolean", length=1, nullable=false)
     */
    private $bif;

    /**
     * @var boolean $lent
     *
     * @ORM\Column(name="lent", type="boolean", length=1, nullable=false)
     */
    private $lent;

    /**
     * @var boolean $vcl
     *
     * @ORM\Column(name="vcl", type="boolean", length=1, nullable=false)
     */
    private $vcl;

    /**
     * @var boolean $vl
     *
     * @ORM\Column(name="vl", type="boolean", length=1, nullable=false)
     */
    private $vl;

    /**
     * @var boolean $vc
     *
     * @ORM\Column(name="vc", type="boolean", length=1, nullable=false)
     */
    private $vc;

    /**
     * @var string $vlod
     *
     * @ORM\Column(name="vlod", type="string", length=1, nullable=false)
     */
    private $vlod;

    /**
     * @var string $vloi
     *
     * @ORM\Column(name="vloi", type="string", length=1, nullable=false)
     */
    private $vloi;

    /**
     * @var string $vlao
     *
     * @ORM\Column(name="vlao", type="string", length=1, nullable=false)
     */
    private $vlao;

    /**
     * @var string $vcod
     *
     * @ORM\Column(name="vcod", type="string", length=1, nullable=false)
     */
    private $vcod;

    /**
     * @var string $vcoi
     *
     * @ORM\Column(name="vcoi", type="string", length=1, nullable=false)
     */
    private $vcoi;

    /**
     * @var string $vcao
     *
     * @ORM\Column(name="vcao", type="string", length=1, nullable=false)
     */
    private $vcao;

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
     * Set lentes
     *
     * @param string $lentes
     */
    public function setLentes($lentes)
    {
        $this->lentes = $lentes;
    }

    /**
     * Get lentes
     *
     * @return string
     */
    public function getLentes()
    {
        return $this->lentes;
    }

    /**
     * Set lentesprueba
     *
     * @param string $lentesprueba
     */
    public function setLentesprueba($lentesprueba)
    {
        $this->lentesprueba = $lentesprueba;
    }

    /**
     * Get lentesprueba
     *
     * @return string
     */
    public function getLentesprueba()
    {
        return $this->lentesprueba;
    }

    /**
     * Set miopia
     *
     * @param boolean $miopia
     */
    public function setMiopia($miopia)
    {
        $this->miopia = $miopia;
    }

    /**
     * Get miopia
     *
     * @return boolean
     */
    public function getMiopia()
    {
        return $this->miopia;
    }

    /**
     * Set hipermetropia
     *
     * @param boolean $hipermetropia
     */
    public function setHipermetropia($hipermetropia)
    {
        $this->hipermetropia = $hipermetropia;
    }

    /**
     * Get hipermetropia
     *
     * @return boolean
     */
    public function getHipermetropia()
    {
        return $this->hipermetropia;
    }

    /**
     * Set astigmatismo
     *
     * @param boolean $astigmatismo
     */
    public function setAstigmatismo($astigmatismo)
    {
        $this->astigmatismo = $astigmatismo;
    }

    /**
     * Get astigmatismo
     *
     * @return boolean
     */
    public function getAstigmatismo()
    {
        return $this->astigmatismo;
    }

    /**
     * Set bif
     *
     * @param boolean $bif
     */
    public function setBif($bif)
    {
        $this->bif = $bif;
    }

    /**
     * Get bif
     *
     * @return boolean
     */
    public function getBif()
    {
        return $this->bif;
    }

    /**
     * Set lent
     *
     * @param boolean $lent
     */
    public function setLent($lent)
    {
        $this->lent = $lent;
    }

    /**
     * Get lent
     *
     * @return boolean
     */
    public function getLent()
    {
        return $this->lent;
    }

    /**
     * Set vcl
     *
     * @param boolean $vcl
     */
    public function setVcl($vcl)
    {
        $this->vcl = $vcl;
    }

    /**
     * Get vcl
     *
     * @return boolean
     */
    public function getVcl()
    {
        return $this->vcl;
    }

    /**
     * Set vl
     *
     * @param boolean $vl
     */
    public function setVl($vl)
    {
        $this->vl = $vl;
    }

    /**
     * Get vl
     *
     * @return boolean
     */
    public function getVl()
    {
        return $this->vl;
    }

    /**
     * Set vc
     *
     * @param boolean $vc
     */
    public function setVc($vc)
    {
        $this->vc = $vc;
    }

    /**
     * Get vc
     *
     * @return boolean
     */
    public function getVc()
    {
        return $this->vc;
    }

    /**
     * Set vlod
     *
     * @param string $vlod
     */
    public function setVlod($vlod)
    {
        $this->vlod = $vlod;
    }

    /**
     * Get vlod
     *
     * @return string
     */
    public function getVlod()
    {
        return $this->vlod;
    }

    /**
     * Set vloi
     *
     * @param string $vloi
     */
    public function setVloi($vloi)
    {
        $this->vloi = $vloi;
    }

    /**
     * Get vloi
     *
     * @return string
     */
    public function getVloi()
    {
        return $this->vloi;
    }

    /**
     * Set vlao
     *
     * @param string $vlao
     */
    public function setVlao($vlao)
    {
        $this->vlao = $vlao;
    }

    /**
     * Get vlao
     *
     * @return string
     */
    public function getVlao()
    {
        return $this->vlao;
    }

    /**
     * Set vcod
     *
     * @param string $vcod
     */
    public function setVcod($vcod)
    {
        $this->vcod = $vcod;
    }

    /**
     * Get vcod
     *
     * @return string
     */
    public function getVcod()
    {
        return $this->vcod;
    }

    /**
     * Set vcoi
     *
     * @param string $vcoi
     */
    public function setVcoi($vcoi)
    {
        $this->vcoi = $vcoi;
    }

    /**
     * Get vcoi
     *
     * @return string
     */
    public function getVcoi()
    {
        return $this->vcoi;
    }

    /**
     * Set vcao
     *
     * @param string $vcao
     */
    public function setVcao($vcao)
    {
        $this->vcao = $vcao;
    }

    /**
     * Get vcao
     *
     * @return string
     */
    public function getVcao()
    {
        return $this->vcao;
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
