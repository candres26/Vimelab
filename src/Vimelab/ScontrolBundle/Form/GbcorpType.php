<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GbcorpType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('identificacion','text', array('label' => 'Identificación'))
            ->add('nombre')
            ->add('rplegal','text', array('label' => 'Representante Legal'))
            ->add('identrplegal','text', array('label' => 'Identificación Representante'))
            ->add('direccion','text', array('label' => 'Dirección'))
            ->add('telefono','text', array('label' => 'Teléfono'))
            ->add('fax')
            ->add('correo')
            ->add('web','text', array('label' => 'Website Empresarial'))
            ->add('logo')
            ->add('empresagbiden', 'entity', array('class' => 'ScontrolBundle:Gbiden', 'label' => 'Identificación Empresa'))
            ->add('representantegbiden', 'entity', array('class' => 'ScontrolBundle:Gbiden', 'label' => 'Identificación Representante'))
            ->add('gbciud', 'entity', array('class' => 'ScontrolBundle:Gbciud', 'label' => 'Ciudad'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_gbcorptype';
    }
}
