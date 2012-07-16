<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class HslaboType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('empresa')
            ->add('fingreso', 'date', array('label' => 'Fecha ingreso','widget' => 'single_text', 'format' => 'y-MM-dd'))
            ->add('actividad', 'textarea', array('label' => 'Actividades que desempeñaba'))
            ->add('puesto', 'textarea', array('label' => 'Puesto que ocupaba'))
            ->add('riesgo')
            ->add('duracion')
            ->add('edad')
            ->add('mdpaci', 'entity', array('class' => 'ScontrolBundle:Mdpaci', 'label' => 'Paciente'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_hslabotype';
    }
}
