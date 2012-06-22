<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TcrutaType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('fplaneada', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd','label' => 'Fecha planeada'))
            ->add('fejecutada', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd','label' => 'Fecha ejecutada'))
            ->add('personal')
            ->add('unidad')
            ->add('equipo', 'text', array('label' => 'Equípo'))
            ->add('lugar')
            ->add('encargado')
            ->add('datos')
            ->add('fparciales')
            ->add('analitica', 'checkbox', array('required' => false,'label' => 'Analítica'))
            ->add('biometria', 'checkbox', array('required' => false,'label' => 'Biometría'))
            ->add('audiometria', 'checkbox', array('required' => false,'label' => 'Audiometría'))
            ->add('vision', 'checkbox', array('required' => false,'label' => 'Control Visión'))
            ->add('espirometria', 'checkbox', array('required' => false,'label' => 'Espirometría'))
            ->add('medica', 'checkbox', array('required' => false,'label' => 'Exploración Médica'))
            ->add('electro', 'choice', array('choices' => array('S' => 'Si', 'N' => 'No'), 'expanded' => 'true'))
            ->add('detelectro', 'text', array('label' => 'Detalle Electro'))
            ->add('comentarios')
            ->add('ncompletos','integer', array('label' => 'No. Reco. Completos'))
            ->add('nanaliticas', 'integer', array('label' => 'No. Analíticas'))
            ->add('nsolas', 'integer', array('label' => 'Analíticas Solas'))
            ->add('necg', 'integer', array('label' => 'No. ECG'))
            ->add('naudiometria', 'integer', array('label' => 'No. Audiometrías'))
            ->add('total', 'integer', array('label' => 'TOTAL Reco'))
            ->add('estado', 'choice', array('choices' => array('A' => 'Activo', 'I' => 'Inactivo'), 'expanded' => 'true'))
            ->add('ctcont', 'entity', array('class' => 'ScontrolBundle:Ctcont', 'label' => 'Contrato'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_tcrutatype';
    }
}
