<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GbcnaeType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('actEcon', 'text', array('label' => 'Actividad económica'))
            ->add('alternativo', 'text', array('label' => 'Actividad económica (en catalán)'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_gbcnaetype';
    }
}
