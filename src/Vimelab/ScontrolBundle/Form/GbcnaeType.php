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
            ->add('codigo', 'text', array('label' => 'Código CNAE'))
            ->add('alternativo', 'text', array('label' => 'Actividad económica (en catalán)', 'required' => false))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_gbcnaetype';
    }
}
