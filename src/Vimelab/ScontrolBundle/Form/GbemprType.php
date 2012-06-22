<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GbemprType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('identificacion', 'text', array('label' => 'Identificación'))
            ->add('tipo')
            ->add('nombre', 'text', array('label' => 'Nombre Empresa'))
            ->add('rplegal', 'text', array('label' => 'Representante Legal'))
            ->add('identrplegal', 'text', array('label' => 'Identificación Representante'))
            ->add('web', 'text', array('label' => 'Website Empresarial'))
            ->add('gbcnae', 'entity', array('class' => 'ScontrolBundle:Gbcnae', 'label' => 'Actividad Económica'))
            ->add('tipoide', 'entity', array('class' => 'ScontrolBundle:Gbiden', 'label' => 'Tipo identificación'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_gbemprtype';
    }
}
