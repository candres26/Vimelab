<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GbaclsType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('modulo', 'text', array('label' => 'Módulo'))
            ->add('accion', 'text', array('label' => 'Acción'))
            ->add('gbusua', 'entity', array('class' => 'ScontrolBundle:Gbusua', 'label' => 'Usuario'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_gbaclstype';
    }
}
