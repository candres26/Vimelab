<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TccapaType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('codigo', 'text', array('label' => 'Código'))
            ->add('nombre')
            ->add('descripcion', 'text', array('label' => 'Descripción'))
            ->add('duracion', 'text', array('label' => 'Duración'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_tccapatype';
    }
}
