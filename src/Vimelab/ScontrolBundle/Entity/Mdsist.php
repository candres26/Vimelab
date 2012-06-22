<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Mdsist
 *
 * @ORM\Table(name="MdSist")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\MdsistRepository")
 */
class Mdsist
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
     * @var string $otoscder
     *
     * @ORM\Column(name="otoscder", type="string", length=1, nullable=false)
     */
    private $otoscder;

    /**
     * @var string $otosciz
     *
     * @ORM\Column(name="otosciz", type="string", length=1, nullable=false)
     */
    private $otosciz;

    /**
     * @var string $boca
     *
     * @ORM\Column(name="boca", type="string", length=1, nullable=false)
     */
    private $boca;

    /**
     * @var string $garganta
     *
     * @ORM\Column(name="garganta", type="string", length=1, nullable=false)
     */
    private $garganta;

    /**
     * @var string $pupilas
     *
     * @ORM\Column(name="pupilas", type="string", length=1, nullable=false)
     */
    private $pupilas;

    /**
     * @var string $columna
     *
     * @ORM\Column(name="columna", type="string", length=1, nullable=false)
     */
    private $columna;

    /**
     * @var string $mucosas
     *
     * @ORM\Column(name="mucosas", type="string", length=1, nullable=false)
     */
    private $mucosas;

    /**
     * @var string $cardiaca
     *
     * @ORM\Column(name="cardiaca", type="string", length=1, nullable=false)
     */
    private $cardiaca;

    /**
     * @var string $respiratoria
     *
     * @ORM\Column(name="respiratoria", type="string", length=1, nullable=false)
     */
    private $respiratoria;

    /**
     * @var string $abdominal
     *
     * @ORM\Column(name="abdominal", type="string", length=1, nullable=false)
     */
    private $abdominal;

    /**
     * @var string $nervioso
     *
     * @ORM\Column(name="nervioso", type="string", length=1, nullable=false)
     */
    private $nervioso;

    /**
     * @var string $ppl
     *
     * @ORM\Column(name="ppl", type="string", length=1, nullable=false)
     */
    private $ppl;

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
     * Set otoscder
     *
     * @param string $otoscder
     */
    public function setOtoscder($otoscder)
    {
        $this->otoscder = $otoscder;
    }

    /**
     * Get otoscder
     *
     * @return string
     */
    public function getOtoscder()
    {
        return $this->otoscder;
    }

    /**
     * Set otosciz
     *
     * @param string $otosciz
     */
    public function setOtosciz($otosciz)
    {
        $this->otosciz = $otosciz;
    }

    /**
     * Get otosciz
     *
     * @return string
     */
    public function getOtosciz()
    {
        return $this->otosciz;
    }

    /**
     * Set boca
     *
     * @param string $boca
     */
    public function setBoca($boca)
    {
        $this->boca = $boca;
    }

    /**
     * Get boca
     *
     * @return string
     */
    public function getBoca()
    {
        return $this->boca;
    }

    /**
     * Set garganta
     *
     * @param string $garganta
     */
    public function setGarganta($garganta)
    {
        $this->garganta = $garganta;
    }

    /**
     * Get garganta
     *
     * @return string
     */
    public function getGarganta()
    {
        return $this->garganta;
    }

    /**
     * Set pupilas
     *
     * @param string $pupilas
     */
    public function setPupilas($pupilas)
    {
        $this->pupilas = $pupilas;
    }

    /**
     * Get pupilas
     *
     * @return string
     */
    public function getPupilas()
    {
        return $this->pupilas;
    }

    /**
     * Set columna
     *
     * @param string $columna
     */
    public function setColumna($columna)
    {
        $this->columna = $columna;
    }

    /**
     * Get columna
     *
     * @return string
     */
    public function getColumna()
    {
        return $this->columna;
    }

    /**
     * Set mucosas
     *
     * @param string $mucosas
     */
    public function setMucosas($mucosas)
    {
        $this->mucosas = $mucosas;
    }

    /**
     * Get mucosas
     *
     * @return string
     */
    public function getMucosas()
    {
        return $this->mucosas;
    }

    /**
     * Set cardiaca
     *
     * @param string $cardiaca
     */
    public function setCardiaca($cardiaca)
    {
        $this->cardiaca = $cardiaca;
    }

    /**
     * Get cardiaca
     *
     * @return string
     */
    public function getCardiaca()
    {
        return $this->cardiaca;
    }

    /**
     * Set respiratoria
     *
     * @param string $respiratoria
     */
    public function setRespiratoria($respiratoria)
    {
        $this->respiratoria = $respiratoria;
    }

    /**
     * Get respiratoria
     *
     * @return string
     */
    public function getRespiratoria()
    {
        return $this->respiratoria;
    }

    /**
     * Set abdominal
     *
     * @param string $abdominal
     */
    public function setAbdominal($abdominal)
    {
        $this->abdominal = $abdominal;
    }

    /**
     * Get abdominal
     *
     * @return string
     */
    public function getAbdominal()
    {
        return $this->abdominal;
    }

    /**
     * Set nervioso
     *
     * @param string $nervioso
     */
    public function setNervioso($nervioso)
    {
        $this->nervioso = $nervioso;
    }

    /**
     * Get nervioso
     *
     * @return string
     */
    public function getNervioso()
    {
        return $this->nervioso;
    }

    /**
     * Set ppl
     *
     * @param string $ppl
     */
    public function setPpl($ppl)
    {
        $this->ppl = $ppl;
    }

    /**
     * Get ppl
     *
     * @return string
     */
    public function getPpl()
    {
        return $this->ppl;
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
