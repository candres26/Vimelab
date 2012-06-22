<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TcchecType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('ntrabajadores', 'text', array('label' => 'No. Trabajadores'))
            ->add('asesoria', 'text', array('label' => 'Asesoría'))
            ->add('comite', 'text', array('label' => 'Comité'))
            ->add('descripcion', 'textarea', array('label' => 'Descripción'))
            ->add('caracteristicas', 'textarea', array('label' => 'Características'))
            ->add('psensible')
            ->add('seguridad')
            ->add('mfisico')
            ->add('hfisico')
            ->add('mquimico')
            ->add('hquimico')
            ->add('mbiologico')
            ->add('hbiologico')
            ->add('cargas')
            ->add('carretilleros')
            ->add('repetitivos')
            ->add('ett')
            ->add('limpieza')
            ->add('mantenimiento')
            ->add('otros')
            ->add('emergencia')
            ->add('simulacros')
            ->add('planos')
            ->add('eplanos')
            ->add('textintor')
            ->add('pemergencia')
            ->add('lemergencia')
            ->add('alarmas')
            ->add('selectrico')
            ->add('sextintor')
            ->add('sevacuacion')
            ->add('slavabos')
            ->add('botiquin')
            ->add('ascensor')
            ->add('bantideslizante')
            ->add('observaciones')
            ->add('tcrevi', 'entity', array('class' => 'ScontrolBundle:Tcrevi', 'label' => 'Revisión'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_tcchectype';
    }
}
