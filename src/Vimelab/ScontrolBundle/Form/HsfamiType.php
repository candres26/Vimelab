<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityRepository;

class HsfamiType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('familiar')
            ->add('detalle')
            ->add('mdpaci', 'entity', array('class' => 'ScontrolBundle:Mdpaci', 'label' => 'Paciente'))
            ->add('mdpato', 'entity', array('class' => 'ScontrolBundle:Mdpato', 'label' => 'Patología'))
        ;
		
		$builder->add('mdpato', 'entity', array('class' => 'ScontrolBundle:Mdpato', 'label' => 'Patología', 
				'query_builder' => function(EntityRepository $er)
				{
					return $er->createQueryBuilder('p')
						->add('select', 'p')
						->add('from', 'ScontrolBundle:Mdpato p')
						->add('where', 'p.codigo < 1900')
						->add('orderBy', 'p.codigo ASC');
				}
				
			));
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_hsfamitype';
    }
}
