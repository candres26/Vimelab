<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityRepository;

class TcreviType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('fecha', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd'))
            ->add('inicio')
            ->add('fin')
            ->add('entrevistados')
            ->add('resumen')
            ->add('gbsucu', 'entity', array('class' => 'ScontrolBundle:Gbsucu', 'label' => 'Sucursal'));

        $builder->add('gbpers', 'entity', array('class' => 'ScontrolBundle:Gbpers', 'label' => 'Personal',
                'query_builder' => function(EntityRepository $er)
                {
                    return $er->createQueryBuilder('p')
                        ->add('select', 'p')
                        ->add('from', 'ScontrolBundle:Gbpers p')
                        ->add('orderBy', 'p.priape ASC');
                }
                
            ));
            
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_tcrevitype';
    }
}
