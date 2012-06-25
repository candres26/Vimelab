<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TcchecType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('ntrabajadores', 'text', array('label' => 'No. Trabajadores'))
            ->add('asesoria', 'text', array('label' => 'Asesoría'))
            ->add('comite', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true','label' => 'Comité de Seguridad y Salud'))
            ->add('descripcion', 'textarea', array('label' => 'Descripción del local'))
            ->add('caracteristicas', 'textarea', array('label' => 'Características de los sitios de trabajo'))
            ->add('psensible', 'textarea', array('label' => 'Personal Especialmente Sensible'))
            ->add('seguridad', 'textarea', array('label' => 'Seguridad (Equipo de Trabajo)'))
            ->add('mfisico', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true','label' => 'Físicos (precisen medición)'))
            ->add('hfisico', 'textarea', array('label' => 'Higiene - Contaminantes Físicos'))
            ->add('mquimico', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true','label' => 'Químicos (precisen medición)'))
            ->add('hquimico', 'textarea', array('label' => 'Higiene - Contaminantes Químicos'))
            ->add('mbiologico', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true','label' => 'Biológicos (precisen medición)'))
            ->add('hbiologico', 'textarea', array('label' => 'Higiene - Contaminantes Biológicos'))
            ->add('cargas')
            ->add('carretilleros', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true','label' => 'Formación Carretilleros'))
            ->add('repetitivos', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true','label' => 'Movimientos Repetitivos'))
            ->add('ett', 'checkbox', array('required' => false,'label' => 'Personal ETT'))
            ->add('limpieza', 'checkbox', array('required' => false,'label' => 'Limpieza'))
            ->add('mantenimiento', 'checkbox', array('required' => false,'label' => 'Mantenimiento'))
            ->add('otros', 'checkbox', array('required' => false,'label' => 'Otros'))
            ->add('emergencia', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true','label' => 'Plan de Emergencia'))
            ->add('simulacros', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true','label' => 'Realización Simulacros'))
            ->add('planos', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true','label' => 'Planos'))
            ->add('eplanos', 'choice', array('choices' => array('I' => 'Inicial', 'A' => 'Avanzado'), 'expanded' => 'true','label' => 'Estado del Plano'))
            ->add('textintor', 'choice', array('choices' => array('ABC' => 'ABC', 'CO2' => 'CO2'), 'expanded' => 'true','label' => 'Tipo de Extintor'))
            ->add('pemergencia', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true','label' => 'Puertas de Emergencia'))
            ->add('lemergencia', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true','label' => 'Luces de Emergencia'))
            ->add('alarmas', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true','label' => 'Detector de Incendios / Alarma'))
            ->add('selectrico', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true','label' => 'Señalización Eléctrico'))
            ->add('sextintor', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true','label' => 'Señalización Extintores'))
            ->add('sevacuacion', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true','label' => 'Señalización Vías de Evacuación'))
            ->add('slavabos', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true','label' => 'Señalización Lavabos'))
            ->add('botiquin', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true','label' => 'Botiquín'))
            ->add('ascensor', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true','label' => 'Ascensor o Montacargas'))
            ->add('bantideslizante', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true','label' => 'Bases Antideslizantes'))
            ->add('observaciones')
            ->add('tcrevi', 'entity', array('class' => 'ScontrolBundle:Tcrevi', 'label' => 'Revisión'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_tcchectype';
    }
}
