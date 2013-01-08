<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityRepository;

class MddiagType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('mdhist', 'entity', array('class' => 'ScontrolBundle:Mdhist', 'label' => 'Historia'));
		
		$builder->add('mdpato', 'entity', array('class' => 'ScontrolBundle:Mdpato', 'label' => 'Patología', 
				'query_builder' => function(EntityRepository $er)
				{
					return $er->createQueryBuilder('p')
						->add('select', 'p')
						->add('from', 'ScontrolBundle:Mdpato p')
						->add('orderBy', 'p.codigo ASC');
				}
				
			));
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_mddiagtype';
    }
}
