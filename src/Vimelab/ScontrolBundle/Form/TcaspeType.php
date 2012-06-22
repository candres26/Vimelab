<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TcaspeType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('codigo', 'text', array('label' => 'Código'))
            ->add('nombre')
            ->add('criterio')
            ->add('medida')
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_tcaspetype';
    }
}
