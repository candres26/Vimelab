<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Mddiag
 *
 * @ORM\Table(name="MdDiag")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\MddiagRepository")
 */
class Mddiag
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
     * @var Mdhist
     *
     * @ORM\ManyToOne(targetEntity="Mdhist")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MdHist_id", referencedColumnName="id")
     * })
     */
    private $mdhist;

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
