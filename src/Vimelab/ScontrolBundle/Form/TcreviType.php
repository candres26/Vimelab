<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TcreviType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('fecha', 'date', array('widget' => 'single_text', 'label' => 'Fecha'))
            ->add('inicio')
            ->add('fin')
            ->add('entrevistados')
            ->add('resumen')
            ->add('gbsucu', 'entity', array('class' => 'ScontrolBundle:Gbsucu', 'label' => 'Sucursal'))
            ->add('gbpers', 'entity', array('class' => 'ScontrolBundle:Gbpers', 'label' => 'Personal'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_tcrevitype';
    }
}
