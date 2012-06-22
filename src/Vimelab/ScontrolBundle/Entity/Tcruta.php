<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Tcruta
 *
 * @ORM\Table(name="TcRuta")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\TcrutaRepository")
 */
class Tcruta
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
     * @var date $fplaneada
     *
     * @ORM\Column(name="fplaneada", type="date", nullable=false)
     */
    private $fplaneada;

    /**
     * @var datetime $fejecutada
     *
     * @ORM\Column(name="fejecutada", type="datetime", nullable=false)
     */
    private $fejecutada;

    /**
     * @var text $personal
     *
     * @ORM\Column(name="personal", type="text", nullable=false)
     */
    private $personal;

    /**
     * @var text $unidad
     *
     * @ORM\Column(name="unidad", type="text", nullable=false)
     */
    private $unidad;

    /**
     * @var text $equipo
     *
     * @ORM\Column(name="equipo", type="text", nullable=false)
     */
    private $equipo;

    /**
     * @var string $lugar
     *
     * @ORM\Column(name="lugar", type="string", length=100, nullable=false)
     */
    private $lugar;

    /**
     * @var string $encargado
     *
     * @ORM\Column(name="encargado", type="string", length=100, nullable=false)
     */
    private $encargado;

    /**
     * @var text $datos
     *
     * @ORM\Column(name="datos", type="text", nullable=false)
     */
    private $datos;

    /**
     * @var text $fparciales
     *
     * @ORM\Column(name="fparciales", type="text", nullable=false)
     */
    private $fparciales;

    /**
     * @var string $analitica
     *
     * @ORM\Column(name="analitica", type="string", length=1, nullable=false)
     */
    private $analitica;

    /**
     * @var string $biometria
     *
     * @ORM\Column(name="biometria", type="string", length=1, nullable=false)
     */
    private $biometria;

    /**
     * @var string $audiometria
     *
     * @ORM\Column(name="audiometria", type="string", length=1, nullable=false)
     */
    private $audiometria;

    /**
     * @var string $vision
     *
     * @ORM\Column(name="vision", type="string", length=1, nullable=false)
     */
    private $vision;

    /**
     * @var string $espirometria
     *
     * @ORM\Column(name="espirometria", type="string", length=1, nullable=false)
     */
    private $espirometria;

    /**
     * @var string $medica
     *
     * @ORM\Column(name="medica", type="string", length=1, nullable=false)
     */
    private $medica;

    /**
     * @var string $electro
     *
     * @ORM\Column(name="electro", type="string", length=1, nullable=false)
     */
    private $electro;

    /**
     * @var text $detelectro
     *
     * @ORM\Column(name="detelectro", type="text", nullable=false)
     */
    private $detelectro;

    /**
     * @var text $comentarios
     *
     * @ORM\Column(name="comentarios", type="text", nullable=true)
     */
    private $comentarios;

    /**
     * @var integer $ncompletos
     *
     * @ORM\Column(name="ncompletos", type="integer", nullable=false)
     */
    private $ncompletos;

    /**
     * @var integer $nanaliticas
     *
     * @ORM\Column(name="nanaliticas", type="integer", nullable=false)
     */
    private $nanaliticas;

    /**
     * @var integer $nsolas
     *
     * @ORM\Column(name="nsolas", type="integer", nullable=false)
     */
    private $nsolas;

    /**
     * @var integer $necg
     *
     * @ORM\Column(name="necg", type="integer", nullable=false)
     */
    private $necg;

    /**
     * @var integer $naudiometria
     *
     * @ORM\Column(name="naudiometria", type="integer", nullable=false)
     */
    private $naudiometria;

    /**
     * @var integer $total
     *
     * @ORM\Column(name="total", type="integer", nullable=false)
     */
    private $total;

    /**
     * @var string $estado
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=false)
     */
    private $estado;

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
     * Set fplaneada
     *
     * @param date $fplaneada
     */
    public function setFplaneada($fplaneada)
    {
        $this->fplaneada = $fplaneada;
    }

    /**
     * Get fplaneada
     *
     * @return date
     */
    public function getFplaneada()
    {
        return $this->fplaneada;
    }

    /**
     * Set fejecutada
     *
     * @param datetime $fejecutada
     */
    public function setFejecutada($fejecutada)
    {
        $this->fejecutada = $fejecutada;
    }

    /**
     * Get fejecutada
     *
     * @return datetime
     */
    public function getFejecutada()
    {
        return $this->fejecutada;
    }

    /**
     * Set personal
     *
     * @param text $personal
     */
    public function setPersonal($personal)
    {
        $this->personal = $personal;
    }

    /**
     * Get personal
     *
     * @return text
     */
    public function getPersonal()
    {
        return $this->personal;
    }

    /**
     * Set unidad
     *
     * @param text $unidad
     */
    public function setUnidad($unidad)
    {
        $this->unidad = $unidad;
    }

    /**
     * Get unidad
     *
     * @return text
     */
    public function getUnidad()
    {
        return $this->unidad;
    }

    /**
     * Set equipo
     *
     * @param text $equipo
     */
    public function setEquipo($equipo)
    {
        $this->equipo = $equipo;
    }

    /**
     * Get equipo
     *
     * @return text
     */
    public function getEquipo()
    {
        return $this->equipo;
    }

    /**
     * Set lugar
     *
     * @param string $lugar
     */
    public function setLugar($lugar)
    {
        $this->lugar = $lugar;
    }

    /**
     * Get lugar
     *
     * @return string
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * Set encargado
     *
     * @param string $encargado
     */
    public function setEncargado($encargado)
    {
        $this->encargado = $encargado;
    }

    /**
     * Get encargado
     *
     * @return string
     */
    public function getEncargado()
    {
        return $this->encargado;
    }

    /**
     * Set datos
     *
     * @param text $datos
     */
    public function setDatos($datos)
    {
        $this->datos = $datos;
    }

    /**
     * Get datos
     *
     * @return text
     */
    public function getDatos()
    {
        return $this->datos;
    }

    /**
     * Set fparciales
     *
     * @param text $fparciales
     */
    public function setFparciales($fparciales)
    {
        $this->fparciales = $fparciales;
    }

    /**
     * Get fparciales
     *
     * @return text
     */
    public function getFparciales()
    {
        return $this->fparciales;
    }

    /**
     * Set analitica
     *
     * @param string $analitica
     */
    public function setAnalitica($analitica)
    {
        $this->analitica = $analitica;
    }

    /**
     * Get analitica
     *
     * @return string
     */
    public function getAnalitica()
    {
        return $this->analitica;
    }

    /**
     * Set biometria
     *
     * @param string $biometria
     */
    public function setBiometria($biometria)
    {
        $this->biometria = $biometria;
    }

    /**
     * Get biometria
     *
     * @return string
     */
    public function getBiometria()
    {
        return $this->biometria;
    }

    /**
     * Set audiometria
     *
     * @param string $audiometria
     */
    public function setAudiometria($audiometria)
    {
        $this->audiometria = $audiometria;
    }

    /**
     * Get audiometria
     *
     * @return string
     */
    public function getAudiometria()
    {
        return $this->audiometria;
    }

    /**
     * Set vision
     *
     * @param string $vision
     */
    public function setVision($vision)
    {
        $this->vision = $vision;
    }

    /**
     * Get vision
     *
     * @return string
     */
    public function getVision()
    {
        return $this->vision;
    }

    /**
     * Set espirometria
     *
     * @param string $espirometria
     */
    public function setEspirometria($espirometria)
    {
        $this->espirometria = $espirometria;
    }

    /**
     * Get espirometria
     *
     * @return string
     */
    public function getEspirometria()
    {
        return $this->espirometria;
    }

    /**
     * Set medica
     *
     * @param string $medica
     */
    public function setMedica($medica)
    {
        $this->medica = $medica;
    }

    /**
     * Get medica
     *
     * @return string
     */
    public function getMedica()
    {
        return $this->medica;
    }

    /**
     * Set electro
     *
     * @param string $electro
     */
    public function setElectro($electro)
    {
        $this->electro = $electro;
    }

    /**
     * Get electro
     *
     * @return string
     */
    public function getElectro()
    {
        return $this->electro;
    }

    /**
     * Set detelectro
     *
     * @param text $detelectro
     */
    public function setDetelectro($detelectro)
    {
        $this->detelectro = $detelectro;
    }

    /**
     * Get detelectro
     *
     * @return text
     */
    public function getDetelectro()
    {
        return $this->detelectro;
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
     * Set ncompletos
     *
     * @param integer $ncompletos
     */
    public function setNcompletos($ncompletos)
    {
        $this->ncompletos = $ncompletos;
    }

    /**
     * Get ncompletos
     *
     * @return integer
     */
    public function getNcompletos()
    {
        return $this->ncompletos;
    }

    /**
     * Set nanaliticas
     *
     * @param integer $nanaliticas
     */
    public function setNanaliticas($nanaliticas)
    {
        $this->nanaliticas = $nanaliticas;
    }

    /**
     * Get nanaliticas
     *
     * @return integer
     */
    public function getNanaliticas()
    {
        return $this->nanaliticas;
    }

    /**
     * Set nsolas
     *
     * @param integer $nsolas
     */
    public function setNsolas($nsolas)
    {
        $this->nsolas = $nsolas;
    }

    /**
     * Get nsolas
     *
     * @return integer
     */
    public function getNsolas()
    {
        return $this->nsolas;
    }

    /**
     * Set necg
     *
     * @param integer $necg
     */
    public function setNecg($necg)
    {
        $this->necg = $necg;
    }

    /**
     * Get necg
     *
     * @return integer
     */
    public function getNecg()
    {
        return $this->necg;
    }

    /**
     * Set naudiometria
     *
     * @param integer $naudiometria
     */
    public function setNaudiometria($naudiometria)
    {
        $this->naudiometria = $naudiometria;
    }

    /**
     * Get naudiometria
     *
     * @return integer
     */
    public function getNaudiometria()
    {
        return $this->naudiometria;
    }

    /**
     * Set total
     *
     * @param integer $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * Get total
     *
     * @return integer
     */
    public function getTotal()
    {
        return $this->total;
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
