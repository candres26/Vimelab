<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Mdques
 *
 * @ORM\Table(name="MdQues")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\MdquesRepository")
 */
class Mdques
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
     * @var text $pregunta
     *
     * @ORM\Column(name="pregunta", type="text", nullable=false)
     */
    private $pregunta;

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
     * Get id
     *
     * @return bigint
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pregunta
     *
     * @param text $pregunta
     */
    public function setPregunta($pregunta)
    {
        $this->pregunta = $pregunta;
    }

    /**
     * Get pregunta
     *
     * @return text
     */
    public function getPregunta()
    {
        return $this->pregunta;
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

    public function __toString()
    {
        return $this->id;
    }
}
