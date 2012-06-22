<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MdsistType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('otoscder', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'label' => 'Otosc. Dcha.'))
            ->add('otosciz', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'label' => 'Otosc. Izqda.'))
            ->add('boca', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true'))
            ->add('garganta', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true'))
            ->add('pupilas', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true'))
            ->add('columna', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'label' => 'Expl. Columna'))
            ->add('mucosas', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'label' => 'Piel y Mucosas'))
            ->add('cardiaca', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'label' => 'Ausc. Cardíaca'))
            ->add('respiratoria', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'label' => 'Ausc. Respiratoria'))
            ->add('abdominal', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'label' => 'Palpación Abdominal'))
            ->add('nervioso', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'label' => 'Sist. Nervioso'))
            ->add('ppl', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'label' => 'PPL'))
            ->add('mdhist', 'entity', array('class' => 'ScontrolBundle:Mdhist', 'label' => 'Hístoria'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_mdsisttype';
    }
}
