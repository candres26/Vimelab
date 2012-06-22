<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GbptraType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('gbempr', 'entity', array('class' => 'ScontrolBundle:Gbempr', 'label' => 'Empresa'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_gbptratype';
    }
}
