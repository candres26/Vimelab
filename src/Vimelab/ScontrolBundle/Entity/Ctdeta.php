<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Ctdeta
 *
 * @ORM\Table(name="CtDeta")
 * @ORM\Entity
 */
class Ctdeta
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
     * @var integer $cantidad
     *
     * @ORM\Column(name="cantidad", type="integer", nullable=false)
     */
    private $cantidad;

    /**
     * @var decimal $vuni
     *
     * @ORM\Column(name="vuni", type="decimal", nullable=false)
     */
    private $vuni;

    /**
     * @var decimal $viva
     *
     * @ORM\Column(name="viva", type="decimal", nullable=false)
     */
    private $viva;

    /**
     * @var decimal $total
     *
     * @ORM\Column(name="total", type="decimal", nullable=false)
     */
    private $total;

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
     * @var Ctfact
     *
     * @ORM\ManyToOne(targetEntity="Ctfact")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CtFact_id", referencedColumnName="id")
     * })
     */
    private $ctfact;



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
     * Set cantidad
     *
     * @param integer $cantidad
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set vuni
     *
     * @param decimal $vuni
     */
    public function setVuni($vuni)
    {
        $this->vuni = $vuni;
    }

    /**
     * Get vuni
     *
     * @return decimal 
     */
    public function getVuni()
    {
        return $this->vuni;
    }

    /**
     * Set viva
     *
     * @param decimal $viva
     */
    public function setViva($viva)
    {
        $this->viva = $viva;
    }

    /**
     * Get viva
     *
     * @return decimal 
     */
    public function getViva()
    {
        return $this->viva;
    }

    /**
     * Set total
     *
     * @param decimal $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * Get total
     *
     * @return decimal 
     */
    public function getTotal()
    {
        return $this->total;
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
     * Set ctfact
     *
     * @param Vimelab\ScontrolBundle\Entity\Ctfact $ctfact
     */
    public function setCtfact(\Vimelab\ScontrolBundle\Entity\Ctfact $ctfact)
    {
        $this->ctfact = $ctfact;
    }

    /**
     * Get ctfact
     *
     * @return Vimelab\ScontrolBundle\Entity\Ctfact 
     */
    public function getCtfact()
    {
        return $this->ctfact;
    }
}