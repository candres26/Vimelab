<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MdespiType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('realizado', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()')))
            ->add('cv','text', array('label' => 'CV'))
            ->add('vems','text', array('label' => 'VEMS'))
            ->add('tiff', 'text', array('label' => 'FEV1/FVC'))
            ->add('mdhist', 'entity', array('class' => 'ScontrolBundle:Mdhist', 'label' => 'Historia'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_mdespitype';
    }
}
