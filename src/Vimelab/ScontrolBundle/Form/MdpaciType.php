<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MdpaciType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('identificacion', 'text', array('label' => 'Identificación'))
            ->add('prinom', 'text', array('label' => 'Primer nombre'))
            ->add('segnom', 'text', array('label' => 'Segundo nombre'))
            ->add('priape', 'text', array('label' => 'Primer apellido'))
            ->add('segape', 'text', array('label' => 'Segundo apellido'))
            ->add('nacimiento', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd'))
            ->add('sexo', 'choice', array('choices' => array('F' => 'Femenino', 'M' => 'Masculino'), 'expanded' => 'true'))
            ->add('direccion', 'text', array('label' => 'Dirección'))
            ->add('telefono', 'text', array('label' => 'Teléfono'))
            ->add('correo')
            ->add('ingreso', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd'))
            ->add('gbciud', 'entity', array('class' => 'ScontrolBundle:Gbciud', 'label' => 'Ciudad'))
            ->add('gbptra', 'entity', array('class' => 'ScontrolBundle:Gbptra', 'label' => 'Puesto Trabajo'))
            ->add('gbsucu', 'entity', array('class' => 'ScontrolBundle:Gbsucu', 'label' => 'Sucursal'))
            ->add('tipoide', 'entity', array('class' => 'ScontrolBundle:Gbiden', 'label' => 'Tipo identificación'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_mdpacitype';
    }
}
