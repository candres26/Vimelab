<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CtfactType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('fecha', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd'))
            ->add('vencimiento', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd'))
            ->add('perini', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd'))
            ->add('perfin', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd'))
            ->add('subtotal')
            ->add('iva')
            ->add('descuento')
            ->add('total')
            ->add('estado', 'choice', array('choices' => array('A' => 'Activo', 'I' => 'Inactivo'), 'expanded' => 'true'))
            ->add('detalle')
            ->add('observaciones')
            ->add('ctcont', 'entity', array('class' => 'ScontrolBundle:Ctcont', 'label' => 'Contrato'))
            ->add('gbpers', 'entity', array('class' => 'ScontrolBundle:Gbpers', 'label' => 'Personal'))
            ->add('gbempr', 'entity', array('class' => 'ScontrolBundle:Gbempr', 'label' => 'Empresa'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_ctfacttype';
    }
}
