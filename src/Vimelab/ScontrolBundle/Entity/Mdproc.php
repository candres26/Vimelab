<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Mdproc
 *
 * @ORM\Table(name="MdProc")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\MdprocRepository")
 */
class Mdproc
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
     * @var Mdprot
     *
     * @ORM\ManyToOne(targetEntity="Mdprot")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MdProt_id", referencedColumnName="id")
     * })
     */
    private $mdprot;

    /**
     * @var Gbptra
     *
     * @ORM\ManyToOne(targetEntity="Gbptra")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="GbPtra_id", referencedColumnName="id")
     * })
     */
    private $gbptra;



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
     * Set mdprot
     *
     * @param Vimelab\ScontrolBundle\Entity\Mdprot $mdprot
     */
    public function setMdprot(\Vimelab\ScontrolBundle\Entity\Mdprot $mdprot)
    {
        $this->mdprot = $mdprot;
    }

    /**
     * Get mdprot
     *
     * @return Vimelab\ScontrolBundle\Entity\Mdprot
     */
    public function getMdprot()
    {
        return $this->mdprot;
    }

    /**
     * Set gbptra
     *
     * @param Vimelab\ScontrolBundle\Entity\Gbptra $gbptra
     */
    public function setGbptra(\Vimelab\ScontrolBundle\Entity\Gbptra $gbptra)
    {
        $this->gbptra = $gbptra;
    }

    /**
     * Get gbptra
     *
     * @return Vimelab\ScontrolBundle\Entity\Gbptra
     */
    public function getGbptra()
    {
        return $this->gbptra;
    }

    public function __toString()
    {
        return $this->id;
    }
}
