<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Mdlabo
 *
 * @ORM\Table(name="MdLabo")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\MdlaboRepository")
 */
class Mdlabo
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
     * @var string $estado
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=false)
     */
    private $estado;

    /**
     * @var text $resultado
     *
     * @ORM\Column(name="resultado", type="text", nullable=false)
     */
    private $resultado;

    /**
     * @var Mdexam
     *
     * @ORM\ManyToOne(targetEntity="Mdexam")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MdExam_id", referencedColumnName="id")
     * })
     */
    private $mdexam;

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
     * @var Ctserv
     *
     * @ORM\ManyToOne(targetEntity="Ctserv")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CtServ_id", referencedColumnName="id")
     * })
     */
    private $ctserv;



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
     * Set estado
     *
     * @param string $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set resultado
     *
     * @param text $resultado
     */
    public function setResultado($resultado)
    {
        $this->resultado = $resultado;
    }

    /**
     * Get resultado
     *
     * @return text
     */
    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Set mdexam
     *
     * @param Vimelab\ScontrolBundle\Entity\Mdexam $mdexam
     */
    public function setMdexam(\Vimelab\ScontrolBundle\Entity\Mdexam $mdexam)
    {
        $this->mdexam = $mdexam;
    }

    /**
     * Get mdexam
     *
     * @return Vimelab\ScontrolBundle\Entity\Mdexam
     */
    public function getMdexam()
    {
        return $this->mdexam;
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

    /**
     * Set ctserv
     *
     * @param Vimelab\ScontrolBundle\Entity\Ctserv $ctserv
     */
    public function setCtserv(\Vimelab\ScontrolBundle\Entity\Ctserv $ctserv)
    {
        $this->ctserv = $ctserv;
    }

    /**
     * Get ctserv
     *
     * @return Vimelab\ScontrolBundle\Entity\Ctserv
     */
    public function getCtserv()
    {
        return $this->ctserv;
    }

    public function __toString()
    {
        return $this->id;
    }
}
