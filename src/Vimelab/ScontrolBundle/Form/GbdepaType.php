<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GbdepaType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('codigo', 'text', array('label' => 'Código'))
            ->add('nombre')
            ->add('gbpais', 'entity', array('class' => 'ScontrolBundle:Gbpais', 'label' => 'País'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_gbdepatype';
    }
}
