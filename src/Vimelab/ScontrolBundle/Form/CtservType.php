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
            ->add('tipo', 'choice' , array('choices' => array('1' => 'Exámenes', '2' => 'Procedimientos', '3' => 'Otros servicios')))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_ctservtype';
    }
}
