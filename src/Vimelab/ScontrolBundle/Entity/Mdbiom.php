<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Mdbiom
 *
 * @ORM\Table(name="MdBiom")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\MdbiomRepository")
 */
class Mdbiom
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
     * @var decimal $talla
     *
     * @ORM\Column(name="talla", type="decimal", nullable=false)
     */
    private $talla;

    /**
     * @var decimal $peso
     *
     * @ORM\Column(name="peso", type="decimal", nullable=false)
     */
    private $peso;

    /**
     * @var decimal $pulso
     *
     * @ORM\Column(name="pulso", type="decimal", nullable=false)
     */
    private $pulso;

    /**
     * @var decimal $pasisto
     *
     * @ORM\Column(name="pasisto", type="decimal", nullable=false)
     */
    private $pasisto;

    /**
     * @var decimal $padiasto
     *
     * @ORM\Column(name="padiasto", type="decimal", nullable=false)
     */
    private $padiasto;

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
     * Set talla
     *
     * @param decimal $talla
     */
    public function setTalla($talla)
    {
        $this->talla = $talla;
    }

    /**
     * Get talla
     *
     * @return decimal
     */
    public function getTalla()
    {
        return $this->talla;
    }

    /**
     * Set peso
     *
     * @param decimal $peso
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;
    }

    /**
     * Get peso
     *
     * @return decimal
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * Set pulso
     *
     * @param decimal $pulso
     */
    public function setPulso($pulso)
    {
        $this->pulso = $pulso;
    }

    /**
     * Get pulso
     *
     * @return decimal
     */
    public function getPulso()
    {
        return $this->pulso;
    }

    /**
     * Set pasisto
     *
     * @param decimal $pasisto
     */
    public function setPasisto($pasisto)
    {
        $this->pasisto = $pasisto;
    }

    /**
     * Get pasisto
     *
     * @return decimal
     */
    public function getPasisto()
    {
        return $this->pasisto;
    }

    /**
     * Set padiasto
     *
     * @param decimal $padiasto
     */
    public function setPadiasto($padiasto)
    {
        $this->padiasto = $padiasto;
    }

    /**
     * Get padiasto
     *
     * @return decimal
     */
    public function getPadiasto()
    {
        return $this->padiasto;
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
    
    public function getImc()
    {
		$talla = intval($this->talla) / 100;
		$peso = intval($this->peso);
		
		$imc = $peso / ($talla * $talla);
		
		if ($imc <= 18)
			$tipo = 1;
		else if($imc >= 18.1 && $imc <= 24.9)
			$tipo = 2;
		else if($imc >= 25 && $imc <= 29.9)
			$tipo = 3;
		else
			$tipo = 4;
		
		return $tipo;
	}
	
	public function getPresion()
	{
		$presistolica = intval($this->pasisto);
		$prediastolica = intval($this->padiasto);
		
		$presion=-1;
		
		if ($presistolica == 120 && $prediastolica == 80)
			$presion = 1;
		else if (($presistolica > 120 && $presistolica <= 129) && ($prediastolica > 80 && $prediastolica <= 84))
			$presion = 2;
		else if (($presistolica >= 130 && $presistolica <= 139) && ($prediastolica >= 85 && $prediastolica <= 89))
			$presion = 3;
		else if (($presistolica >= 140 && $presistolica <= 159) && ($prediastolica >= 90 && $prediastolica <= 99))
			$presion = 4;
		else if (($presistolica >= 160 && $presistolica <= 179) && ($prediastolica >= 100 && $prediastolica <= 109))
			$presion = 5;
		else if (($presistolica >= 180 ) && ($prediastolica >= 110))
			$presion = 6;
		else 
			$presion = 7;
		
		return $presion;
	}
}
