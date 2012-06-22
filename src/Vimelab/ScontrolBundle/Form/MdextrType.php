<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MdextrType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('hdmov', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('himov', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('hdpal', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('hipal', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('hdten', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('hiten', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('hdsur', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('hisur', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('cdmov', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('cimov', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('cdpal', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('cipal', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('mdmov', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('mimov', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('mdpal', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('mipal', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('mdten', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('miten', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('mdhip', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('mihip', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('mdret', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('miret', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('mdsme', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('misme', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('pdmov', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('pimov', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('pddef', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('pidef', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('pdins', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('piins', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'attr' => array('onClick' => 'isMode()') ))
            ->add('comentarios')
            ->add('mdhist', 'entity', array('class' => 'ScontrolBundle:Mdhist', 'label' => 'Historia'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_mdextrtype';
    }
}
