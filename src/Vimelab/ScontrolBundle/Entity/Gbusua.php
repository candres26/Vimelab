<?php

namespace Vimelab\ScontrolBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Gbusua
 *
 * @ORM\Table(name="GbUsua")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\GbusuaRepository")
 */
class Gbusua implements UserInterface, \Serializable
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
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string $clave
     *
     * @ORM\Column(name="clave", type="string", length=50, nullable=false)
     */
    private $clave;

    /**
     * @var Gbpers
     *
     * @ORM\ManyToOne(targetEntity="Gbpers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="GbPers_id", referencedColumnName="id")
     * })
     */
    private $gbpers;



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
     * Set nombre
     *
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set clave
     *
     * @param string $clave
     */
    public function setClave($clave)
    {
        $this->clave = $clave;
    }

    /**
     * Get clave
     *
     * @return string
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Set gbpers
     *
     * @param Vimelab\ScontrolBundle\Entity\Gbpers $gbpers
     */
    public function setGbpers(\Vimelab\ScontrolBundle\Entity\Gbpers $gbpers)
    {
        $this->gbpers = $gbpers;
    }

    /**
     * Get gbpers
     *
     * @return Vimelab\ScontrolBundle\Entity\Gbpers
     */
    public function getGbpers()
    {
        return $this->gbpers;
    }

    /* Funciones Agregadas */
    public function __toString()
    {
        return $this->nombre;
    }

    /* Interfaz de usuario */
    public function equals(UserInterface $user)
    {
        return $this->getUserName() == $user->getUserName();
    }

    public function eraseCredentials()
    {
        return false;
    }

    public function getPassword()
    {
        return $this->clave;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function getSalt()
    {
        return false;
    }

    public function getUserName()
    {
        return $this->nombre;
    }

    public function serialize()
    {
        return serialize($this->id);
    }

    public function unserialize($data)
    {
        $this->id = unserialize($data);
    }
}
