<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MdlaboType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('estado', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'label' => 'Realizado'))
            ->add('resultado')
            ->add('mdexam', 'entity', array('class' => 'ScontrolBundle:Mdexam', 'label' => 'Exámen'))
            ->add('mdhist', 'entity', array('class' => 'ScontrolBundle:Mdhist', 'label' => 'Historia'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_mdlabotype';
    }
}
