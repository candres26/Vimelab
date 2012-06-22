<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MdvisuType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('lentes', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'label' => 'USA LENTES'))
            ->add('lentesprueba', 'choice', array('choices' => array('S' => 'SI', 'N' => 'NO'), 'expanded' => 'true', 'label' => 'EN LA PRUEBA'))
            ->add('miopia', 'checkbox', array('required' => false,'label' => 'MIOPÍA'))
            ->add('hipermetropia', 'checkbox', array('required' => false,'label' => 'HIPERMETROPÍA'))
            ->add('astigmatismo', 'checkbox', array('required' => false,'label' => 'ASTIGMATÍSMO'))
            ->add('bif', 'checkbox', array('required' => false,'label' => 'BIFOCAL'))
            ->add('lent', 'checkbox', array('required' => false, 'label' => 'LENTES'))
            ->add('vcl', 'checkbox', array('required' => false, 'label' => 'V C/L'))
            ->add('vl', 'checkbox', array('required' => false, 'label' => 'VL'))
            ->add('vc', 'checkbox', array('required' => false, 'label' => 'VC'))
            ->add('vlod','text', array('max_length' => 1))
            ->add('vloi','text', array('max_length' => 1))
            ->add('vlao','text', array('max_length' => 1))
            ->add('vcod','text', array('max_length' => 1))
            ->add('vcoi','text', array('max_length' => 1))
            ->add('vcao','text', array('max_length' => 1))
            ->add('mdhist', 'entity', array('class' => 'ScontrolBundle:Mdhist', 'label' => 'Historia'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_mdvisutype';
    }
}
