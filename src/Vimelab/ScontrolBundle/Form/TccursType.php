<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TccursType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('empresa')
            ->add('inicio', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd'))
            ->add('fin', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd'))
            ->add('instructor')
            ->add('detalle')
            ->add('mdpaci', 'entity', array('class' => 'ScontrolBundle:Mdpaci', 'label' => 'Paciente'))
            ->add('tccapa', 'entity', array('class' => 'ScontrolBundle:Tccapa', 'label' => 'Capacitación'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_tccurstype';
    }
}
