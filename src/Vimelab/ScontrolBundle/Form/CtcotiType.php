<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CtcotiType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('fecha', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd'))
            ->add('modalidad')
            ->add('trabajadores')
            ->add('centros')
            ->add('vencimiento')
            ->add('nivel')
            ->add('subtotal')
            ->add('iva')
            ->add('descuento')
            ->add('total')
            ->add('gbempr', 'entity', array('class' => 'ScontrolBundle:Gbempr', 'label' => 'Empresa'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_ctcotitype';
    }
}
