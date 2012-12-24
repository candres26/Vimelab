<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TcdetaType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('evitable', 'choice', array('choices' => array('S' => 'Si', 'N' => 'No', 'C' => 'Condicional')))
            ->add('estimacion', 'choice', array('choices' => array('H' => 'Muy Peligoroso', 'A' => 'Peligroso', 'M' => 'Medianamente Peligroso', 'B' => 'Poco Peligroso', 'L' => 'Muy Poco Peligroso'), 'label' => 'Estimación'))
            ->add('probabilidad', 'choice', array('choices' => array('H' => 'Muy Alta', 'A' => 'Alta', 'M' => 'Media', 'B' => 'Baja', 'L' => 'Muy Baja')))
            ->add('consecuencia', 'choice', array('choices' => array('H' => 'Muy Alta', 'A' => 'Alta', 'M' => 'Media', 'B' => 'Baja', 'L' => 'Muy Baja')))
            ->add('detalle')
            ->add('tcrevi', 'entity', array('class' => 'ScontrolBundle:Tcrevi', 'label' => 'Revisión'))
            ->add('tcaspe', 'entity', array('class' => 'ScontrolBundle:Tcaspe', 'label' => 'Aspecto'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_tcdetatype';
    }
}
