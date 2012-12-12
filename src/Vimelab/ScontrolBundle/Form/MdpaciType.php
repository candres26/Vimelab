<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityRepository;

class MdpaciType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
    	$builder
            ->add('identificacion', 'text', array('label' => 'Identificación'))
            ->add('prinom', 'text', array('label' => 'Primer nombre'))
            ->add('segnom', 'text', array('required' => false, 'label' => 'Segundo nombre'))
            ->add('priape', 'text', array('label' => 'Primer apellido'))
            ->add('segape', 'text', array('required' => false, 'label' => 'Segundo apellido'))
            ->add('nacimiento', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd'))
            ->add('sexo', 'choice', array('choices' => array('F' => 'Femenino', 'M' => 'Masculino'), 'expanded' => 'true'))
            ->add('direccion', 'text', array('label' => 'Dirección'))
            ->add('telefono', 'text', array('label' => 'Teléfono', 'required' => false))
            ->add('correo')
            ->add('ingreso', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd'))
            ->add('gbciud', 'entity', array('class' => 'ScontrolBundle:Gbciud', 'label' => 'Ciudad'))
			->add('tipoide', 'entity', array('class' => 'ScontrolBundle:Gbiden', 'label' => 'Tipo identificación'));
			
		$builder->add('gbsucu', 'entity', array('class' => 'ScontrolBundle:Gbsucu', 'label' => 'Sucursal', 
				'query_builder' => function(EntityRepository $er)
				{
					return $er->createQueryBuilder('s')
						->add('select', 's')
						->add('from', 'ScontrolBundle:Gbsucu s')
						->join('s.gbempr', 'e')
						->add('orderBy', 'e.nombre ASC');
				}
				
			));
		
		$builder->add('gbptra', 'entity', array('class' => 'ScontrolBundle:Gbptra', 'label' => 'Puesto De Trabajo',
				'query_builder' => function(EntityRepository $er)
				{
					return $er->createQueryBuilder('p')
						->add('select', 'p')
						->add('from', 'ScontrolBundle:Gbptra p')
						->join('p.gbempr', 'e')
						->add('orderBy', 'e.nombre ASC');
				}
				
			));	
		
		    
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_mdpacitype';
    }
}
