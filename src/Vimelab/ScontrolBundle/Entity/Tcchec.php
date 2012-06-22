<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Tcchec
 *
 * @ORM\Table(name="TcChec")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\TcchecRepository")
 */
class Tcchec
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
     * @var integer $ntrabajadores
     *
     * @ORM\Column(name="ntrabajadores", type="integer", nullable=false)
     */
    private $ntrabajadores;

    /**
     * @var string $asesoria
     *
     * @ORM\Column(name="asesoria", type="string", length=50, nullable=false)
     */
    private $asesoria;

    /**
     * @var string $comite
     *
     * @ORM\Column(name="comite", type="string", length=1, nullable=false)
     */
    private $comite;

    /**
     * @var text $descripcion
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var text $caracteristicas
     *
     * @ORM\Column(name="caracteristicas", type="text", nullable=false)
     */
    private $caracteristicas;

    /**
     * @var text $psensible
     *
     * @ORM\Column(name="psensible", type="text", nullable=false)
     */
    private $psensible;

    /**
     * @var text $seguridad
     *
     * @ORM\Column(name="seguridad", type="text", nullable=false)
     */
    private $seguridad;

    /**
     * @var string $mfisico
     *
     * @ORM\Column(name="mfisico", type="string", length=1, nullable=false)
     */
    private $mfisico;

    /**
     * @var text $hfisico
     *
     * @ORM\Column(name="hfisico", type="text", nullable=false)
     */
    private $hfisico;

    /**
     * @var string $mquimico
     *
     * @ORM\Column(name="mquimico", type="string", length=1, nullable=false)
     */
    private $mquimico;

    /**
     * @var text $hquimico
     *
     * @ORM\Column(name="hquimico", type="text", nullable=false)
     */
    private $hquimico;

    /**
     * @var string $mbiologico
     *
     * @ORM\Column(name="mbiologico", type="string", length=1, nullable=false)
     */
    private $mbiologico;

    /**
     * @var text $hbiologico
     *
     * @ORM\Column(name="hbiologico", type="text", nullable=false)
     */
    private $hbiologico;

    /**
     * @var text $cargas
     *
     * @ORM\Column(name="cargas", type="text", nullable=false)
     */
    private $cargas;

    /**
     * @var string $carretilleros
     *
     * @ORM\Column(name="carretilleros", type="string", length=1, nullable=false)
     */
    private $carretilleros;

    /**
     * @var string $repetitivos
     *
     * @ORM\Column(name="repetitivos", type="string", length=1, nullable=false)
     */
    private $repetitivos;

    /**
     * @var string $ett
     *
     * @ORM\Column(name="ett", type="string", length=1, nullable=false)
     */
    private $ett;

    /**
     * @var string $limpieza
     *
     * @ORM\Column(name="limpieza", type="string", length=1, nullable=false)
     */
    private $limpieza;

    /**
     * @var string $mantenimiento
     *
     * @ORM\Column(name="mantenimiento", type="string", length=1, nullable=false)
     */
    private $mantenimiento;

    /**
     * @var text $otros
     *
     * @ORM\Column(name="otros", type="text", nullable=true)
     */
    private $otros;

    /**
     * @var string $emergencia
     *
     * @ORM\Column(name="emergencia", type="string", length=1, nullable=false)
     */
    private $emergencia;

    /**
     * @var string $simulacros
     *
     * @ORM\Column(name="simulacros", type="string", length=1, nullable=false)
     */
    private $simulacros;

    /**
     * @var string $planos
     *
     * @ORM\Column(name="planos", type="string", length=1, nullable=false)
     */
    private $planos;

    /**
     * @var string $eplanos
     *
     * @ORM\Column(name="eplanos", type="string", length=1, nullable=false)
     */
    private $eplanos;

    /**
     * @var string $textintor
     *
     * @ORM\Column(name="textintor", type="string", length=1, nullable=false)
     */
    private $textintor;

    /**
     * @var string $pemergencia
     *
     * @ORM\Column(name="pemergencia", type="string", length=1, nullable=false)
     */
    private $pemergencia;

    /**
     * @var string $lemergencia
     *
     * @ORM\Column(name="lemergencia", type="string", length=1, nullable=false)
     */
    private $lemergencia;

    /**
     * @var string $alarmas
     *
     * @ORM\Column(name="alarmas", type="string", length=1, nullable=false)
     */
    private $alarmas;

    /**
     * @var string $selectrico
     *
     * @ORM\Column(name="selectrico", type="string", length=1, nullable=false)
     */
    private $selectrico;

    /**
     * @var string $sextintor
     *
     * @ORM\Column(name="sextintor", type="string", length=1, nullable=false)
     */
    private $sextintor;

    /**
     * @var string $sevacuacion
     *
     * @ORM\Column(name="sevacuacion", type="string", length=1, nullable=false)
     */
    private $sevacuacion;

    /**
     * @var string $slavabos
     *
     * @ORM\Column(name="slavabos", type="string", length=1, nullable=false)
     */
    private $slavabos;

    /**
     * @var string $botiquin
     *
     * @ORM\Column(name="botiquin", type="string", length=1, nullable=false)
     */
    private $botiquin;

    /**
     * @var string $ascensor
     *
     * @ORM\Column(name="ascensor", type="string", length=1, nullable=false)
     */
    private $ascensor;

    /**
     * @var string $bantideslizante
     *
     * @ORM\Column(name="bantideslizante", type="string", length=1, nullable=false)
     */
    private $bantideslizante;

    /**
     * @var text $observaciones
     *
     * @ORM\Column(name="observaciones", type="text", nullable=false)
     */
    private $observaciones;

    /**
     * @var Tcrevi
     *
     * @ORM\ManyToOne(targetEntity="Tcrevi")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TcRevi_id", referencedColumnName="id")
     * })
     */
    private $tcrevi;



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
     * Set ntrabajadores
     *
     * @param integer $ntrabajadores
     */
    public function setNtrabajadores($ntrabajadores)
    {
        $this->ntrabajadores = $ntrabajadores;
    }

    /**
     * Get ntrabajadores
     *
     * @return integer
     */
    public function getNtrabajadores()
    {
        return $this->ntrabajadores;
    }

    /**
     * Set asesoria
     *
     * @param string $asesoria
     */
    public function setAsesoria($asesoria)
    {
        $this->asesoria = $asesoria;
    }

    /**
     * Get asesoria
     *
     * @return string
     */
    public function getAsesoria()
    {
        return $this->asesoria;
    }

    /**
     * Set comite
     *
     * @param string $comite
     */
    public function setComite($comite)
    {
        $this->comite = $comite;
    }

    /**
     * Get comite
     *
     * @return string
     */
    public function getComite()
    {
        return $this->comite;
    }

    /**
     * Set descripcion
     *
     * @param text $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Get descripcion
     *
     * @return text
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set caracteristicas
     *
     * @param text $caracteristicas
     */
    public function setCaracteristicas($caracteristicas)
    {
        $this->caracteristicas = $caracteristicas;
    }

    /**
     * Get caracteristicas
     *
     * @return text
     */
    public function getCaracteristicas()
    {
        return $this->caracteristicas;
    }

    /**
     * Set psensible
     *
     * @param text $psensible
     */
    public function setPsensible($psensible)
    {
        $this->psensible = $psensible;
    }

    /**
     * Get psensible
     *
     * @return text
     */
    public function getPsensible()
    {
        return $this->psensible;
    }

    /**
     * Set seguridad
     *
     * @param text $seguridad
     */
    public function setSeguridad($seguridad)
    {
        $this->seguridad = $seguridad;
    }

    /**
     * Get seguridad
     *
     * @return text
     */
    public function getSeguridad()
    {
        return $this->seguridad;
    }

    /**
     * Set mfisico
     *
     * @param string $mfisico
     */
    public function setMfisico($mfisico)
    {
        $this->mfisico = $mfisico;
    }

    /**
     * Get mfisico
     *
     * @return string
     */
    public function getMfisico()
    {
        return $this->mfisico;
    }

    /**
     * Set hfisico
     *
     * @param text $hfisico
     */
    public function setHfisico($hfisico)
    {
        $this->hfisico = $hfisico;
    }

    /**
     * Get hfisico
     *
     * @return text
     */
    public function getHfisico()
    {
        return $this->hfisico;
    }

    /**
     * Set mquimico
     *
     * @param string $mquimico
     */
    public function setMquimico($mquimico)
    {
        $this->mquimico = $mquimico;
    }

    /**
     * Get mquimico
     *
     * @return string
     */
    public function getMquimico()
    {
        return $this->mquimico;
    }

    /**
     * Set hquimico
     *
     * @param text $hquimico
     */
    public function setHquimico($hquimico)
    {
        $this->hquimico = $hquimico;
    }

    /**
     * Get hquimico
     *
     * @return text
     */
    public function getHquimico()
    {
        return $this->hquimico;
    }

    /**
     * Set mbiologico
     *
     * @param string $mbiologico
     */
    public function setMbiologico($mbiologico)
    {
        $this->mbiologico = $mbiologico;
    }

    /**
     * Get mbiologico
     *
     * @return string
     */
    public function getMbiologico()
    {
        return $this->mbiologico;
    }

    /**
     * Set hbiologico
     *
     * @param text $hbiologico
     */
    public function setHbiologico($hbiologico)
    {
        $this->hbiologico = $hbiologico;
    }

    /**
     * Get hbiologico
     *
     * @return text
     */
    public function getHbiologico()
    {
        return $this->hbiologico;
    }

    /**
     * Set cargas
     *
     * @param text $cargas
     */
    public function setCargas($cargas)
    {
        $this->cargas = $cargas;
    }

    /**
     * Get cargas
     *
     * @return text
     */
    public function getCargas()
    {
        return $this->cargas;
    }

    /**
     * Set carretilleros
     *
     * @param string $carretilleros
     */
    public function setCarretilleros($carretilleros)
    {
        $this->carretilleros = $carretilleros;
    }

    /**
     * Get carretilleros
     *
     * @return string
     */
    public function getCarretilleros()
    {
        return $this->carretilleros;
    }

    /**
     * Set repetitivos
     *
     * @param string $repetitivos
     */
    public function setRepetitivos($repetitivos)
    {
        $this->repetitivos = $repetitivos;
    }

    /**
     * Get repetitivos
     *
     * @return string
     */
    public function getRepetitivos()
    {
        return $this->repetitivos;
    }

    /**
     * Set ett
     *
     * @param string $ett
     */
    public function setEtt($ett)
    {
        $this->ett = $ett;
    }

    /**
     * Get ett
     *
     * @return string
     */
    public function getEtt()
    {
        return $this->ett;
    }

    /**
     * Set limpieza
     *
     * @param string $limpieza
     */
    public function setLimpieza($limpieza)
    {
        $this->limpieza = $limpieza;
    }

    /**
     * Get limpieza
     *
     * @return string
     */
    public function getLimpieza()
    {
        return $this->limpieza;
    }

    /**
     * Set mantenimiento
     *
     * @param string $mantenimiento
     */
    public function setMantenimiento($mantenimiento)
    {
        $this->mantenimiento = $mantenimiento;
    }

    /**
     * Get mantenimiento
     *
     * @return string
     */
    public function getMantenimiento()
    {
        return $this->mantenimiento;
    }

    /**
     * Set otros
     *
     * @param text $otros
     */
    public function setOtros($otros)
    {
        $this->otros = $otros;
    }

    /**
     * Get otros
     *
     * @return text
     */
    public function getOtros()
    {
        return $this->otros;
    }

    /**
     * Set emergencia
     *
     * @param string $emergencia
     */
    public function setEmergencia($emergencia)
    {
        $this->emergencia = $emergencia;
    }

    /**
     * Get emergencia
     *
     * @return string
     */
    public function getEmergencia()
    {
        return $this->emergencia;
    }

    /**
     * Set simulacros
     *
     * @param string $simulacros
     */
    public function setSimulacros($simulacros)
    {
        $this->simulacros = $simulacros;
    }

    /**
     * Get simulacros
     *
     * @return string
     */
    public function getSimulacros()
    {
        return $this->simulacros;
    }

    /**
     * Set planos
     *
     * @param string $planos
     */
    public function setPlanos($planos)
    {
        $this->planos = $planos;
    }

    /**
     * Get planos
     *
     * @return string
     */
    public function getPlanos()
    {
        return $this->planos;
    }

    /**
     * Set eplanos
     *
     * @param string $eplanos
     */
    public function setEplanos($eplanos)
    {
        $this->eplanos = $eplanos;
    }

    /**
     * Get eplanos
     *
     * @return string
     */
    public function getEplanos()
    {
        return $this->eplanos;
    }

    /**
     * Set textintor
     *
     * @param string $textintor
     */
    public function setTextintor($textintor)
    {
        $this->textintor = $textintor;
    }

    /**
     * Get textintor
     *
     * @return string
     */
    public function getTextintor()
    {
        return $this->textintor;
    }

    /**
     * Set pemergencia
     *
     * @param string $pemergencia
     */
    public function setPemergencia($pemergencia)
    {
        $this->pemergencia = $pemergencia;
    }

    /**
     * Get pemergencia
     *
     * @return string
     */
    public function getPemergencia()
    {
        return $this->pemergencia;
    }

    /**
     * Set lemergencia
     *
     * @param string $lemergencia
     */
    public function setLemergencia($lemergencia)
    {
        $this->lemergencia = $lemergencia;
    }

    /**
     * Get lemergencia
     *
     * @return string
     */
    public function getLemergencia()
    {
        return $this->lemergencia;
    }

    /**
     * Set alarmas
     *
     * @param string $alarmas
     */
    public function setAlarmas($alarmas)
    {
        $this->alarmas = $alarmas;
    }

    /**
     * Get alarmas
     *
     * @return string
     */
    public function getAlarmas()
    {
        return $this->alarmas;
    }

    /**
     * Set selectrico
     *
     * @param string $selectrico
     */
    public function setSelectrico($selectrico)
    {
        $this->selectrico = $selectrico;
    }

    /**
     * Get selectrico
     *
     * @return string
     */
    public function getSelectrico()
    {
        return $this->selectrico;
    }

    /**
     * Set sextintor
     *
     * @param string $sextintor
     */
    public function setSextintor($sextintor)
    {
        $this->sextintor = $sextintor;
    }

    /**
     * Get sextintor
     *
     * @return string
     */
    public function getSextintor()
    {
        return $this->sextintor;
    }

    /**
     * Set sevacuacion
     *
     * @param string $sevacuacion
     */
    public function setSevacuacion($sevacuacion)
    {
        $this->sevacuacion = $sevacuacion;
    }

    /**
     * Get sevacuacion
     *
     * @return string
     */
    public function getSevacuacion()
    {
        return $this->sevacuacion;
    }

    /**
     * Set slavabos
     *
     * @param string $slavabos
     */
    public function setSlavabos($slavabos)
    {
        $this->slavabos = $slavabos;
    }

    /**
     * Get slavabos
     *
     * @return string
     */
    public function getSlavabos()
    {
        return $this->slavabos;
    }

    /**
     * Set botiquin
     *
     * @param string $botiquin
     */
    public function setBotiquin($botiquin)
    {
        $this->botiquin = $botiquin;
    }

    /**
     * Get botiquin
     *
     * @return string
     */
    public function getBotiquin()
    {
        return $this->botiquin;
    }

    /**
     * Set ascensor
     *
     * @param string $ascensor
     */
    public function setAscensor($ascensor)
    {
        $this->ascensor = $ascensor;
    }

    /**
     * Get ascensor
     *
     * @return string
     */
    public function getAscensor()
    {
        return $this->ascensor;
    }

    /**
     * Set bantideslizante
     *
     * @param string $bantideslizante
     */
    public function setBantideslizante($bantideslizante)
    {
        $this->bantideslizante = $bantideslizante;
    }

    /**
     * Get bantideslizante
     *
     * @return string
     */
    public function getBantideslizante()
    {
        return $this->bantideslizante;
    }

    /**
     * Set observaciones
     *
     * @param text $observaciones
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }

    /**
     * Get observaciones
     *
     * @return text
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set tcrevi
     *
     * @param Vimelab\ScontrolBundle\Entity\Tcrevi $tcrevi
     */
    public function setTcrevi(\Vimelab\ScontrolBundle\Entity\Tcrevi $tcrevi)
    {
        $this->tcrevi = $tcrevi;
    }

    /**
     * Get tcrevi
     *
     * @return Vimelab\ScontrolBundle\Entity\Tcrevi
     */
    public function getTcrevi()
    {
        return $this->tcrevi;
    }

    public function __toString()
    {
        return $this->id;
    }
}
