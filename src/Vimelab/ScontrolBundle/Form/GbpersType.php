<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GbpersType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('identificacion', 'text', array('label' => 'Identificación'))
            ->add('prinom', 'text', array('label' => 'Primer nombre'))
            ->add('segnom', 'text', array('label' => 'Segundo nombre','required' => false))
            ->add('priape', 'text', array('label' => 'Primer apellido'))
            ->add('segape', 'text', array('label' => 'Segundo apellido','required' => false))
            ->add('nacimiento', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd'))
            ->add('telefono', 'text', array('label' => 'Teléfono'))
            ->add('direccion', 'text', array('label' => 'Dirección'))
            ->add('correo')
            ->add('ingreso', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd'))
            ->add('pdatos', 'checkbox', array('label' => 'Protección de datos','required' => false))
            ->add('estado', 'choice', array('choices' => array('A' => 'Activo', 'I' => 'Inactivo'), 'expanded' => 'true'))
            ->add('gbsucu', 'entity', array('class' => 'ScontrolBundle:Gbsucu', 'label' => 'Sucursal'))
            ->add('gbciud', 'entity', array('class' => 'ScontrolBundle:Gbciud', 'label' => 'Ciudad'))
            ->add('gbiden', 'entity', array('class' => 'ScontrolBundle:Gbiden', 'label' => 'Identificación'))
            ->add('gbcarg', 'entity', array('class' => 'ScontrolBundle:Gbcarg', 'label' => 'Cargo'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_gbperstype';
    }
}
