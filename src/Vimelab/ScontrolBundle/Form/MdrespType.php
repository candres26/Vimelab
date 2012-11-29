<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MdrespType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('resultado', 'choice', array('choices' => array('S' => 'Si', 'N' => 'No'), 'expanded' => 'true'))
            ->add('detalle')
            ->add('mdques', 'entity', array('class' => 'ScontrolBundle:Mdques', 'label' => 'Pregunta'))
            ->add('mdhist', 'entity', array('class' => 'ScontrolBundle:Mdhist', 'label' => 'Historia'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_mdresptype';
    }
}
