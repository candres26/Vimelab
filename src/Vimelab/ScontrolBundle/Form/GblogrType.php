<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GblogrType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('fecha', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd'))
            ->add('modulo', 'text', array('label' => 'Módulo'))
            ->add('accion', 'textarea', array('label' => 'Acción'))
            ->add('gbusua', 'entity', array('class' => 'ScontrolBundle:Gbusua', 'label' => 'Usuario'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_gblogrtype';
    }
}
