<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MdbiomType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('talla')
            ->add('peso')
            ->add('pulso')
            ->add('fres', 'text', array('label' => 'Frecuencia cardíaca'))
            ->add('pasisto', 'text', array('label' => 'Presión arterial sistólica'))
            ->add('padiasto', 'text', array('label' => 'Presión arterial diastólica'))
            ->add('mdhist', 'entity', array('class' => 'ScontrolBundle:Mdhist', 'label' => 'Historia'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_mdbiomtype';
    }
}
