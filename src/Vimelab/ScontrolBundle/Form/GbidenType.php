<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GbidenType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('sigla')
            ->add('detalle')
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_gbidentype';
    }
}
