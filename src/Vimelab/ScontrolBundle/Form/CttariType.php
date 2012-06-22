<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CttariType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('valor')
            ->add('ctserv', 'entity', array('class' => 'ScontrolBundle:Ctserv', 'label' => 'Servicio'))
            ->add('ctcont', 'entity', array('class' => 'ScontrolBundle:Ctcont', 'label' => 'Contrato'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_cttaritype';
    }
}
