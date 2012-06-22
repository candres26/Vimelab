<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TcdetaType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('evitable')
            ->add('estimacion', 'text', array('label' => 'Estimación'))
            ->add('probabilidad')
            ->add('consecuencia')
            ->add('detalle')
            ->add('tcrevi', 'entity', array('class' => 'ScontrolBundle:Tcrevi', 'label' => 'Revisión'))
            ->add('tcaspe', 'entity', array('class' => 'ScontrolBundle:Tcaspe', 'label' => 'Aspecto'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_tcdetatype';
    }
}
