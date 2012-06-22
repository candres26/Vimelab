<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Mdextr
 *
 * @ORM\Table(name="MdExtr")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\MdextrRepository")
 */
class Mdextr
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
     * @var string $hdmov
     *
     * @ORM\Column(name="hdmov", type="string", length=1, nullable=false)
     */
    private $hdmov;

    /**
     * @var string $himov
     *
     * @ORM\Column(name="himov", type="string", length=1, nullable=false)
     */
    private $himov;

    /**
     * @var string $hdpal
     *
     * @ORM\Column(name="hdpal", type="string", length=1, nullable=false)
     */
    private $hdpal;

    /**
     * @var string $hipal
     *
     * @ORM\Column(name="hipal", type="string", length=1, nullable=false)
     */
    private $hipal;

    /**
     * @var string $hdten
     *
     * @ORM\Column(name="hdten", type="string", length=1, nullable=false)
     */
    private $hdten;

    /**
     * @var string $hiten
     *
     * @ORM\Column(name="hiten", type="string", length=1, nullable=false)
     */
    private $hiten;

    /**
     * @var string $hdsur
     *
     * @ORM\Column(name="hdsur", type="string", length=1, nullable=false)
     */
    private $hdsur;

    /**
     * @var string $hisur
     *
     * @ORM\Column(name="hisur", type="string", length=1, nullable=false)
     */
    private $hisur;

    /**
     * @var string $cdmov
     *
     * @ORM\Column(name="cdmov", type="string", length=1, nullable=false)
     */
    private $cdmov;

    /**
     * @var string $cimov
     *
     * @ORM\Column(name="cimov", type="string", length=1, nullable=false)
     */
    private $cimov;

    /**
     * @var string $cdpal
     *
     * @ORM\Column(name="cdpal", type="string", length=1, nullable=false)
     */
    private $cdpal;

    /**
     * @var string $cipal
     *
     * @ORM\Column(name="cipal", type="string", length=1, nullable=false)
     */
    private $cipal;

    /**
     * @var string $mdmov
     *
     * @ORM\Column(name="mdmov", type="string", length=1, nullable=false)
     */
    private $mdmov;

    /**
     * @var string $mimov
     *
     * @ORM\Column(name="mimov", type="string", length=1, nullable=false)
     */
    private $mimov;

    /**
     * @var string $mdpal
     *
     * @ORM\Column(name="mdpal", type="string", length=1, nullable=false)
     */
    private $mdpal;

    /**
     * @var string $mipal
     *
     * @ORM\Column(name="mipal", type="string", length=1, nullable=false)
     */
    private $mipal;

    /**
     * @var string $mdten
     *
     * @ORM\Column(name="mdten", type="string", length=1, nullable=false)
     */
    private $mdten;

    /**
     * @var string $miten
     *
     * @ORM\Column(name="miten", type="string", length=1, nullable=false)
     */
    private $miten;

    /**
     * @var string $mdhip
     *
     * @ORM\Column(name="mdhip", type="string", length=1, nullable=false)
     */
    private $mdhip;

    /**
     * @var string $mihip
     *
     * @ORM\Column(name="mihip", type="string", length=1, nullable=false)
     */
    private $mihip;

    /**
     * @var string $mdret
     *
     * @ORM\Column(name="mdret", type="string", length=1, nullable=false)
     */
    private $mdret;

    /**
     * @var string $miret
     *
     * @ORM\Column(name="miret", type="string", length=1, nullable=false)
     */
    private $miret;

    /**
     * @var string $mdsme
     *
     * @ORM\Column(name="mdsme", type="string", length=1, nullable=false)
     */
    private $mdsme;

    /**
     * @var string $misme
     *
     * @ORM\Column(name="misme", type="string", length=1, nullable=false)
     */
    private $misme;

    /**
     * @var string $pdmov
     *
     * @ORM\Column(name="pdmov", type="string", length=1, nullable=false)
     */
    private $pdmov;
    /**
     * @var string $pimov
     *
     * @ORM\Column(name="pimov", type="string", length=1, nullable=false)
     */
    private $pimov;
    /**
     * @var string $pddef
     *
     * @ORM\Column(name="pddef", type="string", length=1, nullable=false)
     */
    private $pddef;

    /**
     * @var string $pidef
     *
     * @ORM\Column(name="pidef", type="string", length=1, nullable=false)
     */
    private $pidef;

    /**
     * @var string $pdins
     *
     * @ORM\Column(name="pdins", type="string", length=1, nullable=false)
     */
    private $pdins;

    /**
     * @var string $piins
     *
     * @ORM\Column(name="piins", type="string", length=1, nullable=false)
     */
    private $piins;

    /**
     * @var text $comentarios
     *
     * @ORM\Column(name="comentarios", type="text", nullable=false)
     */
    private $comentarios;

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
     * Set hdmov
     *
     * @param string $hdmov
     */
    public function setHdmov($hdmov)
    {
        $this->hdmov = $hdmov;
    }

    /**
     * Get hdmov
     *
     * @return string
     */
    public function getHdmov()
    {
        return $this->hdmov;
    }

    /**
     * Set himov
     *
     * @param string $himov
     */
    public function setHimov($himov)
    {
        $this->himov = $himov;
    }

    /**
     * Get himov
     *
     * @return string
     */
    public function getHimov()
    {
        return $this->himov;
    }

    /**
     * Set hdpal
     *
     * @param string $hdpal
     */
    public function setHdpal($hdpal)
    {
        $this->hdpal = $hdpal;
    }

    /**
     * Get hdpal
     *
     * @return string
     */
    public function getHdpal()
    {
        return $this->hdpal;
    }

    /**
     * Set hipal
     *
     * @param string $hipal
     */
    public function setHipal($hipal)
    {
        $this->hipal = $hipal;
    }

    /**
     * Get hipal
     *
     * @return string
     */
    public function getHipal()
    {
        return $this->hipal;
    }

    /**
     * Set hdten
     *
     * @param string $hdten
     */
    public function setHdten($hdten)
    {
        $this->hdten = $hdten;
    }

    /**
     * Get hdten
     *
     * @return string
     */
    public function getHdten()
    {
        return $this->hdten;
    }

    /**
     * Set hiten
     *
     * @param string $hiten
     */
    public function setHiten($hiten)
    {
        $this->hiten = $hiten;
    }

    /**
     * Get hiten
     *
     * @return string
     */
    public function getHiten()
    {
        return $this->hiten;
    }

    /**
     * Set hdsur
     *
     * @param string $hdsur
     */
    public function setHdsur($hdsur)
    {
        $this->hdsur = $hdsur;
    }

    /**
     * Get hdsur
     *
     * @return string
     */
    public function getHdsur()
    {
        return $this->hdsur;
    }

    /**
     * Set hisur
     *
     * @param string $hisur
     */
    public function setHisur($hisur)
    {
        $this->hisur = $hisur;
    }

    /**
     * Get hisur
     *
     * @return string
     */
    public function getHisur()
    {
        return $this->hisur;
    }

    /**
     * Set cdmov
     *
     * @param string $cdmov
     */
    public function setCdmov($cdmov)
    {
        $this->cdmov = $cdmov;
    }

    /**
     * Get cdmov
     *
     * @return string
     */
    public function getCdmov()
    {
        return $this->cdmov;
    }

    /**
     * Set cimov
     *
     * @param string $cimov
     */
    public function setCimov($cimov)
    {
        $this->cimov = $cimov;
    }

    /**
     * Get cimov
     *
     * @return string
     */
    public function getCimov()
    {
        return $this->cimov;
    }

    /**
     * Set cdpal
     *
     * @param string $cdpal
     */
    public function setCdpal($cdpal)
    {
        $this->cdpal = $cdpal;
    }

    /**
     * Get cdpal
     *
     * @return string
     */
    public function getCdpal()
    {
        return $this->cdpal;
    }

    /**
     * Set cipal
     *
     * @param string $cipal
     */
    public function setCipal($cipal)
    {
        $this->cipal = $cipal;
    }

    /**
     * Get cipal
     *
     * @return string
     */
    public function getCipal()
    {
        return $this->cipal;
    }

    /**
     * Set mdmov
     *
     * @param string $mdmov
     */
    public function setMdmov($mdmov)
    {
        $this->mdmov = $mdmov;
    }

    /**
     * Get mdmov
     *
     * @return string
     */
    public function getMdmov()
    {
        return $this->mdmov;
    }

    /**
     * Set mimov
     *
     * @param string $mimov
     */
    public function setMimov($mimov)
    {
        $this->mimov = $mimov;
    }

    /**
     * Get mimov
     *
     * @return string
     */
    public function getMimov()
    {
        return $this->mimov;
    }

    /**
     * Set mdpal
     *
     * @param string $mdpal
     */
    public function setMdpal($mdpal)
    {
        $this->mdpal = $mdpal;
    }

    /**
     * Get mdpal
     *
     * @return string
     */
    public function getMdpal()
    {
        return $this->mdpal;
    }

    /**
     * Set mipal
     *
     * @param string $mipal
     */
    public function setMipal($mipal)
    {
        $this->mipal = $mipal;
    }

    /**
     * Get mipal
     *
     * @return string
     */
    public function getMipal()
    {
        return $this->mipal;
    }

    /**
     * Set mdten
     *
     * @param string $mdten
     */
    public function setMdten($mdten)
    {
        $this->mdten = $mdten;
    }

    /**
     * Get mdten
     *
     * @return string
     */
    public function getMdten()
    {
        return $this->mdten;
    }

    /**
     * Set miten
     *
     * @param string $miten
     */
    public function setMiten($miten)
    {
        $this->miten = $miten;
    }

    /**
     * Get miten
     *
     * @return string
     */
    public function getMiten()
    {
        return $this->miten;
    }

    /**
     * Set mdhip
     *
     * @param string $mdhip
     */
    public function setMdhip($mdhip)
    {
        $this->mdhip = $mdhip;
    }

    /**
     * Get mdhip
     *
     * @return string
     */
    public function getMdhip()
    {
        return $this->mdhip;
    }

    /**
     * Set mihip
     *
     * @param string $mihip
     */
    public function setMihip($mihip)
    {
        $this->mihip = $mihip;
    }

    /**
     * Get mihip
     *
     * @return string
     */
    public function getMihip()
    {
        return $this->mihip;
    }

    /**
     * Set mdret
     *
     * @param string $mdret
     */
    public function setMdret($mdret)
    {
        $this->mdret = $mdret;
    }

    /**
     * Get mdret
     *
     * @return string
     */
    public function getMdret()
    {
        return $this->mdret;
    }

    /**
     * Set miret
     *
     * @param string $miret
     */
    public function setMiret($miret)
    {
        $this->miret = $miret;
    }

    /**
     * Get miret
     *
     * @return string
     */
    public function getMiret()
    {
        return $this->miret;
    }

    /**
     * Set mdsme
     *
     * @param string $mdsme
     */
    public function setMdsme($mdsme)
    {
        $this->mdsme = $mdsme;
    }

    /**
     * Get mdsme
     *
     * @return string
     */
    public function getMdsme()
    {
        return $this->mdsme;
    }

    /**
     * Set misme
     *
     * @param string $misme
     */
    public function setMisme($misme)
    {
        $this->misme = $misme;
    }

    /**
     * Get misme
     *
     * @return string
     */
    public function getMisme()
    {
        return $this->misme;
    }

    /**
     * Set pdmov
     *
     * @param string $pdmov
     */
    public function setPdmov($pdmov)
    {
        $this->pdmov = $pdmov;
    }

    /**
     * Get pdmov
     *
     * @return string
     */
    public function getPdmov()
    {
        return $this->pdmov;
    }
    /**
     * Set pimov
     *
     * @param string $pimov
     */
    public function setPimov($pimov)
    {
        $this->pimov = $pimov;
    }

    /**
     * Get pimov
     *
     * @return string
     */
    public function getPimov()
    {
        return $this->pimov;
    }
    
    /**
     * Set pddef
     *
     * @param string $pddef
     */
    public function setPddef($pddef)
    {
        $this->pddef = $pddef;
    }

    /**
     * Get pddef
     *
     * @return string
     */
    public function getPddef()
    {
        return $this->pddef;
    }

    /**
     * Set pidef
     *
     * @param string $pidef
     */
    public function setPidef($pidef)
    {
        $this->pidef = $pidef;
    }

    /**
     * Get pidef
     *
     * @return string
     */
    public function getPidef()
    {
        return $this->pidef;
    }

    /**
     * Set pdins
     *
     * @param string $pdins
     */
    public function setPdins($pdins)
    {
        $this->pdins = $pdins;
    }

    /**
     * Get pdins
     *
     * @return string
     */
    public function getPdins()
    {
        return $this->pdins;
    }

    /**
     * Set piins
     *
     * @param string $piins
     */
    public function setPiins($piins)
    {
        $this->piins = $piins;
    }

    /**
     * Get piins
     *
     * @return string
     */
    public function getPiins()
    {
        return $this->piins;
    }

    /**
     * Set comentarios
     *
     * @param text $comentarios
     */
    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;
    }

    /**
     * Get comentarios
     *
     * @return text
     */
    public function getComentarios()
    {
        return $this->comentarios;
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
