<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MddiagType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('mdhist', 'entity', array('class' => 'ScontrolBundle:Mdhist', 'label' => 'Historia'))
            ->add('mdpato', 'entity', array('class' => 'ScontrolBundle:Mdpato', 'label' => 'Patología'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_mddiagtype';
    }
}
