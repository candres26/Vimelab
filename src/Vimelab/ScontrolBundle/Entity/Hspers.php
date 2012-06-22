<?php

namespace Vimelab\ScontrolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vimelab\ScontrolBundle\Entity\Hspers
 *
 * @ORM\Table(name="HsPers")
 * @ORM\Entity(repositoryClass="Vimelab\ScontrolBundle\Repository\HspersRepository")
 */
class Hspers
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
     * @var date $fecha
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var string $evento
     *
     * @ORM\Column(name="evento", type="string", length=1, nullable=false)
     */
    private $evento;

    /**
     * @var text $operaciones
     *
     * @ORM\Column(name="operaciones", type="text", nullable=true)
     */
    private $operaciones;

    /**
     * @var text $productos
     *
     * @ORM\Column(name="productos", type="text", nullable=true)
     */
    private $productos;

    /**
     * @var text $riesgos
     *
     * @ORM\Column(name="riesgos", type="text", nullable=true)
     */
    private $riesgos;

    /**
     * @var text $texposicion
     *
     * @ORM\Column(name="texposicion", type="text", nullable=true)
     */
    private $texposicion;

    /**
     * @var text $proteccion
     *
     * @ORM\Column(name="proteccion", type="text", nullable=true)
     */
    private $proteccion;

    /**
     * @var text $ventilacion
     *
     * @ORM\Column(name="ventilacion", type="text", nullable=true)
     */
    private $ventilacion;

    /**
     * @var text $temperatura
     *
     * @ORM\Column(name="temperatura", type="text", nullable=true)
     */
    private $temperatura;

    /**
     * @var text $horario
     *
     * @ORM\Column(name="horario", type="text", nullable=true)
     */
    private $horario;

    /**
     * @var text $turno
     *
     * @ORM\Column(name="turno", type="text", nullable=true)
     */
    private $turno;

    /**
     * @var text $rotacion
     *
     * @ORM\Column(name="rotacion", type="text", nullable=true)
     */
    private $rotacion;

    /**
     * @var text $visitas
     *
     * @ORM\Column(name="visitas", type="text", nullable=true)
     */
    private $visitas;

    /**
     * @var text $bajas
     *
     * @ORM\Column(name="bajas", type="text", nullable=true)
     */
    private $bajas;

    /**
     * @var text $medicamentos
     *
     * @ORM\Column(name="medicamentos", type="text", nullable=true)
     */
    private $medicamentos;

    /**
     * @var string $fumador
     *
     * @ORM\Column(name="fumador", type="string", length=1, nullable=true)
     */
    private $fumador;

    /**
     * @var text $detfumador
     *
     * @ORM\Column(name="detfumador", type="text", nullable=true)
     */
    private $detfumador;

    /**
     * @var string $bebedor
     *
     * @ORM\Column(name="bebedor", type="string", length=1, nullable=true)
     */
    private $bebedor;

    /**
     * @var text $detbebedor
     *
     * @ORM\Column(name="detbebedor", type="text", nullable=true)
     */
    private $detbebedor;

    /**
     * @var text $efpulmon
     *
     * @ORM\Column(name="efpulmon", type="text", nullable=true)
     */
    private $efpulmon;

    /**
     * @var text $efcorazon
     *
     * @ORM\Column(name="efcorazon", type="text", nullable=true)
     */
    private $efcorazon;

    /**
     * @var text $efasma
     *
     * @ORM\Column(name="efasma", type="text", nullable=true)
     */
    private $efasma;

    /**
     * @var text $efbronquios
     *
     * @ORM\Column(name="efbronquios", type="text", nullable=true)
     */
    private $efbronquios;

    /**
     * @var text $efcirculacion
     *
     * @ORM\Column(name="efcirculacion", type="text", nullable=true)
     */
    private $efcirculacion;

    /**
     * @var text $efhigado
     *
     * @ORM\Column(name="efhigado", type="text", nullable=true)
     */
    private $efhigado;

    /**
     * @var text $efgastritis
     *
     * @ORM\Column(name="efgastritis", type="text", nullable=true)
     */
    private $efgastritis;

    /**
     * @var text $efulcera
     *
     * @ORM\Column(name="efulcera", type="text", nullable=true)
     */
    private $efulcera;

    /**
     * @var text $efvesicula
     *
     * @ORM\Column(name="efvesicula", type="text", nullable=true)
     */
    private $efvesicula;

    /**
     * @var text $efriñon
     *
     * @ORM\Column(name="efriñon", type="text", nullable=true)
     */
    private $efriñon;

    /**
     * @var text $efurinario
     *
     * @ORM\Column(name="efurinario", type="text", nullable=true)
     */
    private $efurinario;

    /**
     * @var text $efartrosis
     *
     * @ORM\Column(name="efartrosis", type="text", nullable=true)
     */
    private $efartrosis;

    /**
     * @var text $eflumbago
     *
     * @ORM\Column(name="eflumbago", type="text", nullable=true)
     */
    private $eflumbago;

    /**
     * @var text $efotros
     *
     * @ORM\Column(name="efotros", type="text", nullable=true)
     */
    private $efotros;

    /**
     * @var text $alergias
     *
     * @ORM\Column(name="alergias", type="text", nullable=true)
     */
    private $alergias;

    /**
     * @var text $prazucar
     *
     * @ORM\Column(name="prazucar", type="text", nullable=true)
     */
    private $prazucar;

    /**
     * @var text $prcolesterol
     *
     * @ORM\Column(name="prcolesterol", type="text", nullable=true)
     */
    private $prcolesterol;

    /**
     * @var text $prurico
     *
     * @ORM\Column(name="prurico", type="text", nullable=true)
     */
    private $prurico;

    /**
     * @var text $prhepatitis
     *
     * @ORM\Column(name="prhepatitis", type="text", nullable=true)
     */
    private $prhepatitis;

    /**
     * @var text $prtransaminasas
     *
     * @ORM\Column(name="prtransaminasas", type="text", nullable=true)
     */
    private $prtransaminasas;

    /**
     * @var text $prhipertension
     *
     * @ORM\Column(name="prhipertension", type="text", nullable=true)
     */
    private $prhipertension;

    /**
     * @var text $prhipotension
     *
     * @ORM\Column(name="prhipotension", type="text", nullable=true)
     */
    private $prhipotension;

    /**
     * @var text $prsoplos
     *
     * @ORM\Column(name="prsoplos", type="text", nullable=true)
     */
    private $prsoplos;

    /**
     * @var text $prarritmias
     *
     * @ORM\Column(name="prarritmias", type="text", nullable=true)
     */
    private $prarritmias;

    /**
     * @var text $prhernias
     *
     * @ORM\Column(name="prhernias", type="text", nullable=true)
     */
    private $prhernias;

    /**
     * @var text $prdepresion
     *
     * @ORM\Column(name="prdepresion", type="text", nullable=true)
     */
    private $prdepresion;

    /**
     * @var text $cbintestinal
     *
     * @ORM\Column(name="cbintestinal", type="text", nullable=true)
     */
    private $cbintestinal;

    /**
     * @var text $cborina
     *
     * @ORM\Column(name="cborina", type="text", nullable=true)
     */
    private $cborina;

    /**
     * @var text $cbpiel
     *
     * @ORM\Column(name="cbpiel", type="text", nullable=true)
     */
    private $cbpiel;

    /**
     * @var text $cbpeso
     *
     * @ORM\Column(name="cbpeso", type="text", nullable=true)
     */
    private $cbpeso;

    /**
     * @var string $tetano
     *
     * @ORM\Column(name="tetano", type="string", length=1, nullable=true)
     */
    private $tetano;

    /**
     * @var date $tetanofecha
     *
     * @ORM\Column(name="tetanofecha", type="date", nullable=true)
     */
    private $tetanofecha;

    /**
     * @var text $tetanodosis
     *
     * @ORM\Column(name="tetanodosis", type="text", nullable=true)
     */
    private $tetanodosis;

    /**
     * @var text $observaciones
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @var Mdpaci
     *
     * @ORM\ManyToOne(targetEntity="Mdpaci")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MdPaci_id", referencedColumnName="id")
     * })
     */
    private $mdpaci;



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
     * Set fecha
     *
     * @param date $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Get fecha
     *
     * @return date
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set evento
     *
     * @param string $evento
     */
    public function setEvento($evento)
    {
        $this->evento = $evento;
    }

    /**
     * Get evento
     *
     * @return string
     */
    public function getEvento()
    {
        return $this->evento;
    }

    /**
     * Set operaciones
     *
     * @param text $operaciones
     */
    public function setOperaciones($operaciones)
    {
        $this->operaciones = $operaciones;
    }

    /**
     * Get operaciones
     *
     * @return text
     */
    public function getOperaciones()
    {
        return $this->operaciones;
    }

    /**
     * Set productos
     *
     * @param text $productos
     */
    public function setProductos($productos)
    {
        $this->productos = $productos;
    }

    /**
     * Get productos
     *
     * @return text
     */
    public function getProductos()
    {
        return $this->productos;
    }

    /**
     * Set riesgos
     *
     * @param text $riesgos
     */
    public function setRiesgos($riesgos)
    {
        $this->riesgos = $riesgos;
    }

    /**
     * Get riesgos
     *
     * @return text
     */
    public function getRiesgos()
    {
        return $this->riesgos;
    }

    /**
     * Set texposicion
     *
     * @param text $texposicion
     */
    public function setTexposicion($texposicion)
    {
        $this->texposicion = $texposicion;
    }

    /**
     * Get texposicion
     *
     * @return text
     */
    public function getTexposicion()
    {
        return $this->texposicion;
    }

    /**
     * Set proteccion
     *
     * @param text $proteccion
     */
    public function setProteccion($proteccion)
    {
        $this->proteccion = $proteccion;
    }

    /**
     * Get proteccion
     *
     * @return text
     */
    public function getProteccion()
    {
        return $this->proteccion;
    }

    /**
     * Set ventilacion
     *
     * @param text $ventilacion
     */
    public function setVentilacion($ventilacion)
    {
        $this->ventilacion = $ventilacion;
    }

    /**
     * Get ventilacion
     *
     * @return text
     */
    public function getVentilacion()
    {
        return $this->ventilacion;
    }

    /**
     * Set temperatura
     *
     * @param text $temperatura
     */
    public function setTemperatura($temperatura)
    {
        $this->temperatura = $temperatura;
    }

    /**
     * Get temperatura
     *
     * @return text
     */
    public function getTemperatura()
    {
        return $this->temperatura;
    }

    /**
     * Set horario
     *
     * @param text $horario
     */
    public function setHorario($horario)
    {
        $this->horario = $horario;
    }

    /**
     * Get horario
     *
     * @return text
     */
    public function getHorario()
    {
        return $this->horario;
    }

    /**
     * Set turno
     *
     * @param text $turno
     */
    public function setTurno($turno)
    {
        $this->turno = $turno;
    }

    /**
     * Get turno
     *
     * @return text
     */
    public function getTurno()
    {
        return $this->turno;
    }

    /**
     * Set rotacion
     *
     * @param text $rotacion
     */
    public function setRotacion($rotacion)
    {
        $this->rotacion = $rotacion;
    }

    /**
     * Get rotacion
     *
     * @return text
     */
    public function getRotacion()
    {
        return $this->rotacion;
    }

    /**
     * Set visitas
     *
     * @param text $visitas
     */
    public function setVisitas($visitas)
    {
        $this->visitas = $visitas;
    }

    /**
     * Get visitas
     *
     * @return text
     */
    public function getVisitas()
    {
        return $this->visitas;
    }

    /**
     * Set bajas
     *
     * @param text $bajas
     */
    public function setBajas($bajas)
    {
        $this->bajas = $bajas;
    }

    /**
     * Get bajas
     *
     * @return text
     */
    public function getBajas()
    {
        return $this->bajas;
    }

    /**
     * Set medicamentos
     *
     * @param text $medicamentos
     */
    public function setMedicamentos($medicamentos)
    {
        $this->medicamentos = $medicamentos;
    }

    /**
     * Get medicamentos
     *
     * @return text
     */
    public function getMedicamentos()
    {
        return $this->medicamentos;
    }

    /**
     * Set fumador
     *
     * @param string $fumador
     */
    public function setFumador($fumador)
    {
        $this->fumador = $fumador;
    }

    /**
     * Get fumador
     *
     * @return string
     */
    public function getFumador()
    {
        return $this->fumador;
    }

    /**
     * Set detfumador
     *
     * @param text $detfumador
     */
    public function setDetfumador($detfumador)
    {
        $this->detfumador = $detfumador;
    }

    /**
     * Get detfumador
     *
     * @return text
     */
    public function getDetfumador()
    {
        return $this->detfumador;
    }

    /**
     * Set bebedor
     *
     * @param string $bebedor
     */
    public function setBebedor($bebedor)
    {
        $this->bebedor = $bebedor;
    }

    /**
     * Get bebedor
     *
     * @return string
     */
    public function getBebedor()
    {
        return $this->bebedor;
    }

    /**
     * Set detbebedor
     *
     * @param text $detbebedor
     */
    public function setDetbebedor($detbebedor)
    {
        $this->detbebedor = $detbebedor;
    }

    /**
     * Get detbebedor
     *
     * @return text
     */
    public function getDetbebedor()
    {
        return $this->detbebedor;
    }

    /**
     * Set efpulmon
     *
     * @param text $efpulmon
     */
    public function setEfpulmon($efpulmon)
    {
        $this->efpulmon = $efpulmon;
    }

    /**
     * Get efpulmon
     *
     * @return text
     */
    public function getEfpulmon()
    {
        return $this->efpulmon;
    }

    /**
     * Set efcorazon
     *
     * @param text $efcorazon
     */
    public function setEfcorazon($efcorazon)
    {
        $this->efcorazon = $efcorazon;
    }

    /**
     * Get efcorazon
     *
     * @return text
     */
    public function getEfcorazon()
    {
        return $this->efcorazon;
    }

    /**
     * Set efasma
     *
     * @param text $efasma
     */
    public function setEfasma($efasma)
    {
        $this->efasma = $efasma;
    }

    /**
     * Get efasma
     *
     * @return text
     */
    public function getEfasma()
    {
        return $this->efasma;
    }

    /**
     * Set efbronquios
     *
     * @param text $efbronquios
     */
    public function setEfbronquios($efbronquios)
    {
        $this->efbronquios = $efbronquios;
    }

    /**
     * Get efbronquios
     *
     * @return text
     */
    public function getEfbronquios()
    {
        return $this->efbronquios;
    }

    /**
     * Set efcirculacion
     *
     * @param text $efcirculacion
     */
    public function setEfcirculacion($efcirculacion)
    {
        $this->efcirculacion = $efcirculacion;
    }

    /**
     * Get efcirculacion
     *
     * @return text
     */
    public function getEfcirculacion()
    {
        return $this->efcirculacion;
    }

    /**
     * Set efhigado
     *
     * @param text $efhigado
     */
    public function setEfhigado($efhigado)
    {
        $this->efhigado = $efhigado;
    }

    /**
     * Get efhigado
     *
     * @return text
     */
    public function getEfhigado()
    {
        return $this->efhigado;
    }

    /**
     * Set efgastritis
     *
     * @param text $efgastritis
     */
    public function setEfgastritis($efgastritis)
    {
        $this->efgastritis = $efgastritis;
    }

    /**
     * Get efgastritis
     *
     * @return text
     */
    public function getEfgastritis()
    {
        return $this->efgastritis;
    }

    /**
     * Set efulcera
     *
     * @param text $efulcera
     */
    public function setEfulcera($efulcera)
    {
        $this->efulcera = $efulcera;
    }

    /**
     * Get efulcera
     *
     * @return text
     */
    public function getEfulcera()
    {
        return $this->efulcera;
    }

    /**
     * Set efvesicula
     *
     * @param text $efvesicula
     */
    public function setEfvesicula($efvesicula)
    {
        $this->efvesicula = $efvesicula;
    }

    /**
     * Get efvesicula
     *
     * @return text
     */
    public function getEfvesicula()
    {
        return $this->efvesicula;
    }

    /**
     * Set efriñon
     *
     * @param text $efriñon
     */
    public function setEfriñon($efriñon)
    {
        $this->efriñon = $efriñon;
    }

    /**
     * Get efriñon
     *
     * @return text
     */
    public function getEfriñon()
    {
        return $this->efriñon;
    }

    /**
     * Set efurinario
     *
     * @param text $efurinario
     */
    public function setEfurinario($efurinario)
    {
        $this->efurinario = $efurinario;
    }

    /**
     * Get efurinario
     *
     * @return text
     */
    public function getEfurinario()
    {
        return $this->efurinario;
    }

    /**
     * Set efartrosis
     *
     * @param text $efartrosis
     */
    public function setEfartrosis($efartrosis)
    {
        $this->efartrosis = $efartrosis;
    }

    /**
     * Get efartrosis
     *
     * @return text
     */
    public function getEfartrosis()
    {
        return $this->efartrosis;
    }

    /**
     * Set eflumbago
     *
     * @param text $eflumbago
     */
    public function setEflumbago($eflumbago)
    {
        $this->eflumbago = $eflumbago;
    }

    /**
     * Get eflumbago
     *
     * @return text
     */
    public function getEflumbago()
    {
        return $this->eflumbago;
    }

    /**
     * Set efotros
     *
     * @param text $efotros
     */
    public function setEfotros($efotros)
    {
        $this->efotros = $efotros;
    }

    /**
     * Get efotros
     *
     * @return text
     */
    public function getEfotros()
    {
        return $this->efotros;
    }

    /**
     * Set alergias
     *
     * @param text $alergias
     */
    public function setAlergias($alergias)
    {
        $this->alergias = $alergias;
    }

    /**
     * Get alergias
     *
     * @return text
     */
    public function getAlergias()
    {
        return $this->alergias;
    }

    /**
     * Set prazucar
     *
     * @param text $prazucar
     */
    public function setPrazucar($prazucar)
    {
        $this->prazucar = $prazucar;
    }

    /**
     * Get prazucar
     *
     * @return text
     */
    public function getPrazucar()
    {
        return $this->prazucar;
    }

    /**
     * Set prcolesterol
     *
     * @param text $prcolesterol
     */
    public function setPrcolesterol($prcolesterol)
    {
        $this->prcolesterol = $prcolesterol;
    }

    /**
     * Get prcolesterol
     *
     * @return text
     */
    public function getPrcolesterol()
    {
        return $this->prcolesterol;
    }

    /**
     * Set prurico
     *
     * @param text $prurico
     */
    public function setPrurico($prurico)
    {
        $this->prurico = $prurico;
    }

    /**
     * Get prurico
     *
     * @return text
     */
    public function getPrurico()
    {
        return $this->prurico;
    }

    /**
     * Set prhepatitis
     *
     * @param text $prhepatitis
     */
    public function setPrhepatitis($prhepatitis)
    {
        $this->prhepatitis = $prhepatitis;
    }

    /**
     * Get prhepatitis
     *
     * @return text
     */
    public function getPrhepatitis()
    {
        return $this->prhepatitis;
    }

    /**
     * Set prtransaminasas
     *
     * @param text $prtransaminasas
     */
    public function setPrtransaminasas($prtransaminasas)
    {
        $this->prtransaminasas = $prtransaminasas;
    }

    /**
     * Get prtransaminasas
     *
     * @return text
     */
    public function getPrtransaminasas()
    {
        return $this->prtransaminasas;
    }

    /**
     * Set prhipertension
     *
     * @param text $prhipertension
     */
    public function setPrhipertension($prhipertension)
    {
        $this->prhipertension = $prhipertension;
    }

    /**
     * Get prhipertension
     *
     * @return text
     */
    public function getPrhipertension()
    {
        return $this->prhipertension;
    }

    /**
     * Set prhipotension
     *
     * @param text $prhipotension
     */
    public function setPrhipotension($prhipotension)
    {
        $this->prhipotension = $prhipotension;
    }

    /**
     * Get prhipotension
     *
     * @return text
     */
    public function getPrhipotension()
    {
        return $this->prhipotension;
    }

    /**
     * Set prsoplos
     *
     * @param text $prsoplos
     */
    public function setPrsoplos($prsoplos)
    {
        $this->prsoplos = $prsoplos;
    }

    /**
     * Get prsoplos
     *
     * @return text
     */
    public function getPrsoplos()
    {
        return $this->prsoplos;
    }

    /**
     * Set prarritmias
     *
     * @param text $prarritmias
     */
    public function setPrarritmias($prarritmias)
    {
        $this->prarritmias = $prarritmias;
    }

    /**
     * Get prarritmias
     *
     * @return text
     */
    public function getPrarritmias()
    {
        return $this->prarritmias;
    }

    /**
     * Set prhernias
     *
     * @param text $prhernias
     */
    public function setPrhernias($prhernias)
    {
        $this->prhernias = $prhernias;
    }

    /**
     * Get prhernias
     *
     * @return text
     */
    public function getPrhernias()
    {
        return $this->prhernias;
    }

    /**
     * Set prdepresion
     *
     * @param text $prdepresion
     */
    public function setPrdepresion($prdepresion)
    {
        $this->prdepresion = $prdepresion;
    }

    /**
     * Get prdepresion
     *
     * @return text
     */
    public function getPrdepresion()
    {
        return $this->prdepresion;
    }

    /**
     * Set cbintestinal
     *
     * @param text $cbintestinal
     */
    public function setCbintestinal($cbintestinal)
    {
        $this->cbintestinal = $cbintestinal;
    }

    /**
     * Get cbintestinal
     *
     * @return text
     */
    public function getCbintestinal()
    {
        return $this->cbintestinal;
    }

    /**
     * Set cborina
     *
     * @param text $cborina
     */
    public function setCborina($cborina)
    {
        $this->cborina = $cborina;
    }

    /**
     * Get cborina
     *
     * @return text
     */
    public function getCborina()
    {
        return $this->cborina;
    }

    /**
     * Set cbpiel
     *
     * @param text $cbpiel
     */
    public function setCbpiel($cbpiel)
    {
        $this->cbpiel = $cbpiel;
    }

    /**
     * Get cbpiel
     *
     * @return text
     */
    public function getCbpiel()
    {
        return $this->cbpiel;
    }

    /**
     * Set cbpeso
     *
     * @param text $cbpeso
     */
    public function setCbpeso($cbpeso)
    {
        $this->cbpeso = $cbpeso;
    }

    /**
     * Get cbpeso
     *
     * @return text
     */
    public function getCbpeso()
    {
        return $this->cbpeso;
    }

    /**
     * Set tetano
     *
     * @param string $tetano
     */
    public function setTetano($tetano)
    {
        $this->tetano = $tetano;
    }

    /**
     * Get tetano
     *
     * @return string
     */
    public function getTetano()
    {
        return $this->tetano;
    }

    /**
     * Set tetanofecha
     *
     * @param date $tetanofecha
     */
    public function setTetanofecha($tetanofecha)
    {
        $this->tetanofecha = $tetanofecha;
    }

    /**
     * Get tetanofecha
     *
     * @return date
     */
    public function getTetanofecha()
    {
        return $this->tetanofecha;
    }

    /**
     * Set tetanodosis
     *
     * @param text $tetanodosis
     */
    public function setTetanodosis($tetanodosis)
    {
        $this->tetanodosis = $tetanodosis;
    }

    /**
     * Get tetanodosis
     *
     * @return text
     */
    public function getTetanodosis()
    {
        return $this->tetanodosis;
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
     * Set mdpaci
     *
     * @param Vimelab\ScontrolBundle\Entity\Mdpaci $mdpaci
     */
    public function setMdpaci(\Vimelab\ScontrolBundle\Entity\Mdpaci $mdpaci)
    {
        $this->mdpaci = $mdpaci;
    }

    /**
     * Get mdpaci
     *
     * @return Vimelab\ScontrolBundle\Entity\Mdpaci
     */
    public function getMdpaci()
    {
        return $this->mdpaci;
    }

    public function __toString()
    {
        return $this->id;
    }
}
