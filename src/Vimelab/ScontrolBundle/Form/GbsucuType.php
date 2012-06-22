<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GbsucuType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('telefono', 'text', array('label' => 'Teléfono'))
            ->add('tele2', 'text', array('label' => 'Teléfono 2'))
            ->add('fax')
            ->add('contacto')
            ->add('direccion', 'text', array('label' => 'Dirección'))
            ->add('correo')
            ->add('gbempr', 'entity', array('class' => 'ScontrolBundle:Gbempr', 'label' => 'Empresa'))
            ->add('gbciud', 'entity', array('class' => 'ScontrolBundle:Gbciud', 'label' => 'Ciudad'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_gbsucutype';
    }
}
