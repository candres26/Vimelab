<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MdquesType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('pregunta')
            ->add('mdprot', 'entity', array('class' => 'ScontrolBundle:Mdprot', 'label' => 'Protocolo'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_mdquestype';
    }
}
