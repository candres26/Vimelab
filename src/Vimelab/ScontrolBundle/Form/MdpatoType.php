<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityRepository;

class MdpatoType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('codigo', 'text', array('label' => 'Código'))
            ->add('nombre')
            ->add('alternativo');
            
        $builder->add('mdgrup', 'entity', array('class' => 'ScontrolBundle:Mdgrup', 'label' => 'Grupo',
        'query_builder' => function(EntityRepository $er)
				{
					return $er->createQueryBuilder('g')
						->add('select', 'g')
						->add('from', 'ScontrolBundle:Mdgrup g')
						->add('orderBy', 'g.nombre ASC');
				}
				
			));
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_mdpatotype';
    }
}
