<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CtcontType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('fecha', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd'))
            ->add('inicio', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd', 'label' => 'Fecha Inicio'))
            ->add('fin', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd', 'label' => 'Fecha Finalización'))
            ->add('identcontratista', 'text',array('label' => 'Identificación Contratista'))
            ->add('cargocontratista', 'text',array('label' => 'Cargo Contratista'))
            ->add('nombrecontratista', 'text',array('label' => 'Nombre Contratista'))
            ->add('direccioncontratista', 'text',array('label' => 'Dirección Contratista'))
            ->add('identcontratante', 'text',array('label' => 'Identificación Contratante'))
            ->add('cargocontratante', 'text',array('label' => 'Cargo Contratante'))
            ->add('nombrecontratante', 'text', array('label' => 'Nombre Contratante', 'attr' => array('class' => "test")))
            ->add('direccioncontratante', 'text',array('label' => 'Dirección Contratante'))
            ->add('revision', 'text', array('label' => 'Revisión'))
            ->add('aviso')
            ->add('costovigencia', 'text', array('label' => 'Costo Vigencia'))
            ->add('subtotal')
            ->add('iva')
            ->add('descuento')
            ->add('total')
            ->add('saldo')
            ->add('gbpers','entity', array('class' => 'ScontrolBundle:Gbpers', 'label' => 'Personal'))
            ->add('gbempr', 'entity', array('class' => 'ScontrolBundle:Gbempr', 'label' => 'Empresa'))
            ->add('contratantegbiden', 'entity', array('class' => 'ScontrolBundle:Gbiden', 'label' => 'Identificación Contratante'))
            ->add('contratistagbiden', 'entity', array('class' => 'ScontrolBundle:Gbiden', 'label' => 'Identificación Contratista'))
            ->add('firmagbciud', 'entity', array('class' => 'ScontrolBundle:Gbciud', 'label' => 'Ciudad Firma'))
            ->add('legalgbciud', 'entity', array('class' => 'ScontrolBundle:Gbciud', 'label' => 'Ciudad Legal'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_ctconttype';
    }
}
