<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MdgrupType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('alternativo')
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_mdgruptype';
    }
}
