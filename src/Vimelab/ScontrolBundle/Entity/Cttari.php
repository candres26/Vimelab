<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Cttari
 *
 * @ORM\Table(name="CtTari")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\CttariRepository")
 */
class Cttari
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
     * @var decimal $valor
     *
     * @ORM\Column(name="valor", type="decimal", nullable=false)
     */
    private $valor;

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
     * @var Ctcont
     *
     * @ORM\ManyToOne(targetEntity="Ctcont")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CtCont_id", referencedColumnName="id")
     * })
     */
    private $ctcont;



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
     * Set valor
     *
     * @param decimal $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    /**
     * Get valor
     *
     * @return decimal
     */
    public function getValor()
    {
        return $this->valor;
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

    /**
     * Set ctcont
     *
     * @param Vimelab\ScontrolBundle\Entity\Ctcont $ctcont
     */
    public function setCtcont(\Vimelab\ScontrolBundle\Entity\Ctcont $ctcont)
    {
        $this->ctcont = $ctcont;
    }

    /**
     * Get ctcont
     *
     * @return Vimelab\ScontrolBundle\Entity\Ctcont
     */
    public function getCtcont()
    {
        return $this->ctcont;
    }

    public function __toString()
    {
        return $this->id;
    }
}
