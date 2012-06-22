<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GbciudType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('codigo', 'text', array('label' => 'Código'))
            ->add('nombre')
            ->add('gbdepa', 'entity', array('class' => 'ScontrolBundle:Gbdepa', 'label' => 'Província'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_gbciudtype';
    }
}
