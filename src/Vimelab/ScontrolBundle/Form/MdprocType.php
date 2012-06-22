<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MdprocType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('mdprot', 'entity', array('class' => 'ScontrolBundle:Mdprot', 'label' => 'Protocolo'))
            ->add('gbptra', 'entity', array('class' => 'ScontrolBundle:Gbptra', 'label' => 'Puesto de trabajo'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_mdproctype';
    }
}
