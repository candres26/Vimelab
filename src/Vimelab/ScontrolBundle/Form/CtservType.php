<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CtservType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('codigo', 'text', array('label' => 'Código'))
            ->add('nombre')
            ->add('iva')
            ->add('tipo')
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_ctservtype';
    }
}
