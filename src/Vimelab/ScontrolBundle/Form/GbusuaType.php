<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GbusuaType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nombre', 'text', array('label' => 'Usuario'))
            ->add('clave', 'password', array('label' => 'Clave'))
            ->add('gbpers', 'entity', array('class' => 'ScontrolBundle:Gbpers', 'label' => 'Personal'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_gbusuatype';
    }
}
