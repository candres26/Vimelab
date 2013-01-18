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
            ->add('inicio', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd', 'label' => 'Fecha de inicio'))
            ->add('fin', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd', 'label' => 'Fecha de finalización'))
            ->add('identcontratista', 'text',array('label' => 'Identificación contratista'))
            ->add('cargocontratista', 'text',array('label' => 'Cargo contratista'))
            ->add('nombrecontratista', 'text',array('label' => 'Nombre contratista'))
            ->add('direccioncontratista', 'text',array('label' => 'Dirección contratista'))
            ->add('identcontratante', 'text',array('label' => 'Identificación contratante'))
            ->add('cargocontratante', 'text',array('label' => 'Cargo Contratante'))
            ->add('nombrecontratante', 'text', array('label' => 'Nombre contratante', 'attr' => array('class' => "test")))
            ->add('direccioncontratante', 'text',array('label' => 'Dirección contratante'))
            ->add('ntrabajadores', 'text',array('label'=> 'Número de Trabajadores'))
            ->add('vletras', 'text',array('label'=> 'Valor en letras'))
            ->add('revision', 'text', array('label' => 'Revisión'))
            ->add('aviso')
            ->add('costovigencia', 'text', array('label' => 'Costo vigencia'))
            ->add('valrevi', 'text', array('label' => 'Valor de la Revisión'))
			->add('tipo', 'choice', array('choices' => array('1' => 'SHE', '2' => 'Vigilancia', '3' => 'SHE & Vigilancia')))
            ->add('subtotal')
            ->add('iva')
            ->add('descuento')
            ->add('total')
            ->add('saldo')
            ->add('gbpers','entity', array('class' => 'ScontrolBundle:Gbpers', 'label' => 'Personal'))
            ->add('gbempr', 'entity', array('class' => 'ScontrolBundle:Gbempr', 'label' => 'Empresa'))
            ->add('contratantegbiden', 'entity', array('class' => 'ScontrolBundle:Gbiden', 'label' => 'Tipo de documento contratante'))
            ->add('contratistagbiden', 'entity', array('class' => 'ScontrolBundle:Gbiden', 'label' => 'Tipo de documento contratista'))
            ->add('firmagbciud', 'entity', array('class' => 'ScontrolBundle:Gbciud', 'label' => 'Ciudad firma'))
            ->add('legalgbciud', 'entity', array('class' => 'ScontrolBundle:Gbciud', 'label' => 'Ciudad legal'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_ctconttype';
    }
}
