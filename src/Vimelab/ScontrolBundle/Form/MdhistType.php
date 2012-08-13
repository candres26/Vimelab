<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MdhistType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('genero', 'choice', array('choices' => array('M' => 'Masculino', 'F' => 'Femenino'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()'),'required' => false, 'label' => 'Género'))
            ->add('menstru', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'label' => 'Menstruación'))
            ->add('tipo', 'choice', array('choices' => array(0 => 'Ingreso', 1 => 'Periódico', 2 => 'Cambio de puesto', 3 => 'Reincorporación', 4 => 'Egreso'), 'required' => false))
            ->add('mdpaci', 'entity', array('class' => 'ScontrolBundle:Mdpaci', 'label' => 'Paciente'))
            ->add('gbpers', 'entity', array('class' => 'ScontrolBundle:Gbpers', 'label' => 'Personal'))
            ->add('tcruta', 'entity', array('class' => 'ScontrolBundle:Tcruta', 'label' => 'Hoja Ruta'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_mdhisttype';
    }
}
