<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class HsfamiType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('familiar')
            ->add('detalle')
            ->add('mdpaci', 'entity', array('class' => 'ScontrolBundle:Mdpaci', 'label' => 'Paciente'))
            ->add('mdpato', 'entity', array('class' => 'ScontrolBundle:Mdpato', 'label' => 'Patología'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_hsfamitype';
    }
}
